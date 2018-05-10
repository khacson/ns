 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Language extends CI_Controller {
    var $phonedetail;
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('base_model','login_model','excel_model'));
        $this->phonedetail = 'g_processdetail';
		$this->login = $this->site->getSession('glogin');
		$this->route = $this->router->class;
		$this->load->library('upload');
    }
    function _remap($method, $params = array()) {
        $id = $this->uri->segment(2);
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        $this->_view();
    }
    function _view() {
		$data = new stdClass();
        $login = $this->login;
        if (!isset($login['id'])){
			redirect(base_url());
		}
		$permission = $this->base_model->getPermission($this->login, $this->route);
        if(!isset($permission['view'])) {
            redirect('authorize');
        }
		$data->permission = $permission;
        $data->routes = $this->route; 
        $data->groupid = $login['groupid'];
		#gegion add log
		$ctrol = 'Ngôn ngữ';
		$func =  'Xem';
		$this->base_model->addAcction($ctrol,$func,'','');
		#end	
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
        $this->site->render();
    }
    function getList() {
        $permission = $this->base_model->getPermission($this->login, $this->route);
        if (!isset($permission['view'])) {
            //redirect('authorize');
        }
        $rows = 20; //$this->site->config['row'];
        $page = $this->input->post('page');
        $pageStart = $page * $rows;
        $rowEnd = ($page + 1) * $rows;
        $start = empty($page) ? 1 : $page + 1;
        $searchs = json_decode($this->input->post('search'), true);
        $data = new stdClass();
        $result = new stdClass();
        $query = $this->model->getList($searchs, $page, $rows);
        $count = $this->model->getTotal($searchs);
        $data->datas = $query;
        $data->start = $start;
        $data->permission = $this->base_model->getPermission($this->login, $this->route);
        $page_view = $this->site->pagination($count, $rows, 5, $this->route, $page);
		if($count <= $rows){
			$page_view = '';
		}
		
        $result->paging = $page_view;
        $result->csrfHash = $this->security->get_csrf_hash();
        $result->viewtotal = $count;
        $result->content = $this->load->view('list', $data, true);
        echo json_encode($result);
    }
    function save() {
        $token = $this->security->get_csrf_hash();
        $permission = $this->base_model->getPermission($this->login, $this->route);
		$id = $this->input->post('id');
        if (!isset($permission['view'])) {
            redirect('authorize');
        }
        if (!isset($permission['add'])) {
            $result['status'] = 0;
            $result['csrfHash'] = $token;
            echo json_encode($result);
            exit;
        }
        $array = json_decode($this->input->post('search'), true);
		if(isset($_FILES['avatarfile']) && $_FILES['avatarfile']['name'] != "") {
			$imge_name = $_FILES['avatarfile']['name'];
			$this->upload->initialize($this->set_upload_options());
			$image_data = $this->upload->do_upload('avatarfile', $imge_name); //Ten hinh 
			$array['image']  = $image_data;
			$resize = $this->resizeImg($image_data);	
		}
        $login = $this->login;
        $array['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
        $array['usercreate'] = $login['userlogin'];
        //$array['ipcreate'] = $this->base_model->getMacAddress();
		
        $result['status'] = $this->model->saves($array,$id);
		#region logfile
		$ctrol = 'Ngôn ngữ';
		$func =  'Thêm mới: '.$array['langname'];
		$this->base_model->addAcction($ctrol,$func,'','');	
		#end
		
        $result['csrfHash'] = $token;
        echo json_encode($result);
    }
	function edit() {
        $token = $this->security->get_csrf_hash();
        $permission = $this->base_model->getPermission($this->login, $this->route);
		$id = $this->input->post('id');
        if (!isset($permission['view'])) {
            redirect('authorize');
        }
        if (!isset($permission['edit'])) {
            $result['status'] = 0;
            $result['csrfHash'] = $token;
            echo json_encode($result);
            exit;
        }
        $array = json_decode($this->input->post('search'), true);
		if(isset($_FILES['avatarfile']) && $_FILES['avatarfile']['name'] != "") {
			$imge_name = $_FILES['avatarfile']['name'];
			$this->upload->initialize($this->set_upload_options());
			$image_data = $this->upload->do_upload('avatarfile', $imge_name); //Ten hinh 
			$array['image']  = $image_data;
			$resize = $this->resizeImg($image_data);	
		}
        $login = $this->login;
        $array['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
        $array['userupdate'] = $login['userlogin'];
		$findID = $this->model->findID($id);
        $result['status'] = $this->model->edits($array,$id);
		$findIDEnd = $this->model->findID($id);
		#region logfile
		$ctrol = 'Ngôn ngữ';
		$func =  'Sửa: '.$array['langname'];
		$this->base_model->addAcction($ctrol,$func,json_encode($findID),json_encode($findIDEnd));	
		#end
        $result['csrfHash'] = $token;
        echo json_encode($result);
    }
    function deletes() {
        $token = $this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $permission = $this->base_model->getPermission($this->login, $this->route);
        if (!isset($permission['view'])) {
            redirect('authorize');
        }
        if (!isset($permission['delete'])) {
            $result['status'] = 0;
            $result['csrfHash'] = $token;
            echo json_encode($result);
            exit;
        }
		$findID = $this->model->findID($id);
        $login = $this->login;
        $array['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
        $array['userupdate'] = $login['userlogin'];
        $array['isdelete'] = 1;
        $this->model->deletes($id,$array);
        $result['status'] = 1;
        $result['csrfHash'] = $token;
		#region logfile
		$ctrol = 'Ngôn ngữ';
		$func =  'Xóa: '.$findID->langname;
		$this->base_model->addAcction($ctrol,$func,json_encode($findID),'');	
		#end
        echo json_encode($result);
    }
	function resizeImg($image_data) {
        $this->load->library('image_lib');
        $configz = array();
        $configz['image_library'] = 'gd2';
        $configz['source_image'] = './files/lang/' . $image_data;
        $configz['new_image'] = './files/lang/' . $image_data;
        $configz['create_thumb'] = TRUE;
        $configz['maintain_ratio'] = TRUE;
        $configz['width'] = 60;
        $configz['height'] = 50;

        $this->image_lib->initialize($configz);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    private function set_upload_options() {
        $config = array();
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['upload_path'] = './files/lang/';
        $config['encrypt_nam'] = 'TRUE';
        $config['remove_spaces'] = TRUE;
        //$config['max_size'] = 0024;
        return $config;
    }
}