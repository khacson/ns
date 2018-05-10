 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Group extends CI_Controller {
    var $phonedetail;
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('base_model','login_model','excel_model'));
        $this->phonedetail = 'hre_processdetail';
		$this->login = $this->site->getSession('glogin');
		$this->route = $this->router->class;
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
		$data->grouptype = $login['grouptype'];
		$data->companyid = $login['companyid'];
		$data->companys = $this->model->getCompany($login['companyid']);
        $content = $this->load->view('view', $data, true);
		#gegion add log
		$ctrol = getLanguage('nhom-quyen');
		$func =  getLanguage('xem');
		$this->base_model->addAcction($ctrol,$func,'','');
		#end
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
    function getRight() {
        $id = $this->input->post('id');
        $infor = $this->model->findID($id);
        if (!empty($infor->id)) {
            $permission = $infor->params;
        } else {
            $permission = null;
            $id = "";
        }
        $menu = $this->model->getMenuRight($permission);
        //print_r($menu); die();
        $data = array();
        $data['menu'] = $menu['menu'];
        $data['root'] = $menu['chk'];
        $data['id'] = $id;
        $data['infor'] = $infor;
        $content = $this->load->view('right', $data, true);
        $result = new stdClass();
        $result->content = $content;
        $result->csrfHash = $this->security->get_csrf_hash();
        echo json_encode($result);
    }
    function setRight() {
        $permission = $this->base_model->getPermission($this->login, $this->route);
        if (!isset($permission['view'])) {
            $result['status'] = 0;
            echo json_encode($result);
            exit;
        }
		$id = $this->input->post('id');
		$findID = $this->model->findID($id);
        $param = array();
        $param['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
        $param['usercreate'] = $this->login['userlogin'];
        $param['params'] = trim($this->input->post('right'));
        $this->model->table('hre_groups')->save($id, $param);
		#gegion add log
		$ctrol = getLanguage('nhom-quyen');
		$func =  getLanguage('sua-phan-quyen').': '.$findID->groupname;
		$this->base_model->addAcction($ctrol,$func,'','');
		#end
        $result['status'] = 1;
        $result['csrfHash'] = $this->security->get_csrf_hash();
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
		unset( $array['search_code']);
        if (empty($array['groupname'])) {
            $result['status'] = 0;
            $result['csrfHash'] = $token;
            echo json_encode($result);
            exit;
        }
		$findID = $this->model->findID($id);
        $login = $this->login;
        $array['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
        $array['usercreate'] = $login['userlogin'];
        $array['ipcreate'] = $this->base_model->getMacAddress();
		if(!empty($login['companyid'])){
			$array['companyid'] = $login['companyid'];
		}
        $result['status'] = $this->model->saves($array,$id);
		$findIDEnd = $this->model->findID($id);
		#gegion add log
		$ctrol = getLanguage('nhom-quyen');
		$func =  getLanguage('sua').': '.$array['groupname'];
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
        $array['ipupdate'] = $this->base_model->getMacAddress();
        $array['isdelete'] = 1;
        $this->model->table('hre_groups')->where("id in ($id)")->update($array);
		#region logfile
		$ctrol = getLanguage('nhom-quyen');
		$func =  getLanguage('xoa').': '.$findID->colorname ;
		$this->base_model->addAcction($ctrol,$func,json_encode($findID),'');	
		#end
        $result['status'] = 1;
        $result['csrfHash'] = $token;
        echo json_encode($result);
    }
}