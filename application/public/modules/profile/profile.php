 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Profile extends CI_Controller {
    var $phonedetail;
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('base_model','login_model','excel_model'));
        $this->phonedetail = 'hre_processdetail';
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
		$id = $login['id'];
		$data->find = $this->model->findID($id);	
		$data->customers = array();//$this->base_model->getCustomer();
		$data->permission = $permission;
        $data->routes = $this->route; 
        $data->groupid = $login['groupid'];
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
        $this->site->render();
    }
    function save() {
        $token = $this->security->get_csrf_hash();
        $permission = $this->base_model->getPermission($this->login, $this->route);
		$id = $this->input->post('id');
        if (!isset($permission['view'])) {
            redirect('authorize');
        }
        $array = json_decode($this->input->post('search'), true);
		if(isset($_FILES['userfile']) && $_FILES['userfile']['name'] != "") {
			$imge_name = $_FILES['userfile']['name'];
			$this->upload->initialize($this->set_upload_options());
			$image_data = $this->upload->do_upload('userfile', $imge_name); //Ten hinh 
			$array['avatar']  = $image_data;
			$resize = $this->resizeImg($image_data);	
		}
        $login = $this->login;
        $array['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
        $array['usercreate'] = $login['userlogin'];
        if(!empty($array['password'])){
			$pass =  md5(md5($array['password']."@SNK2017"));
			$password = $pass. md5('sonnk');  
			$array['password'] = $password;
		}
		else{
			unset($array['password']);
		}
        $this->model->table('hre_users')->save($id, $array);
		$result['status'] = $id;
        $result['csrfHash'] = $token;
        echo json_encode($result);
    }
	function resizeImg($image_data) {
        $this->load->library('image_lib');
        $configz = array();
        $configz['image_library'] = 'gd2';
        $configz['source_image'] = './files/user/' . $image_data;
        $configz['new_image'] = './files/user/' . $image_data;
        $configz['create_thumb'] = TRUE;
        $configz['maintain_ratio'] = TRUE;
        $configz['width'] = 100;
        $configz['height'] = 100;

        $this->image_lib->initialize($configz);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    private function set_upload_options() {
        $config = array();
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['upload_path'] = './files/user/';
        $config['encrypt_nam'] = 'TRUE';
        $config['remove_spaces'] = TRUE;
        //$config['max_size'] = 0024;
        return $config;
    }
}