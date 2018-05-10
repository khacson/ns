 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Dashboard extends CI_Controller {
    var $phonedetail;
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('base_model','login_model','excel_model'));
        $this->phonedetail = 'g_processdetail';
		$this->login = $this->site->getSession('glogin');
		$this->route = $this->router->class;
		$this->load->library('upload');
		$this->site->setTemplate('dashboard');
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
		$data->fromdate = gmdate("d/m/Y", time() + 7 * 3600);
		$data->toate = gmdate("d/m/Y", time() + 7 * 3600);
		$data->branchid = $login['branchid'];
		$data->branchs = $this->base_model->getBranch($login['branchid']);
		$data->permission = $permission;
        $data->routes = $this->route; 
        $data->groupid = $login['groupid'];
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
		$this->site->write('title', 'Tổng quan', true);
        $this->site->render();
    }
	function loadData(){
		$login = $this->login;
		$fromdate = $this->input->post('fromdate');
		$todate = $this->input->post('todate');
		$result = $data = new stdClass();
		$permission = $this->base_model->getPermission($this->login, $this->route);
		$data->permission = $permission;
		//viewClm
		$data->accepts = 0;
		$data->wip = 0;
		$data->noTransfers = 0;
		$data->transferCustomer = 0;
		$data->prices = 0;
		$data->countInputs = 0;
		//Chart
		$data->processList = 0;

		
		$result->viewClm = $this->load->view('viewClm', $data, true);
		$result->viewChart = $this->load->view('viewChart', $data, true);
        echo json_encode($result);
	}
	function viewDetail(){
		$result = new stdClass();
		$data = new stdClass();
		$id = $this->input->post('id');
		$result->content = $this->load->view($id, $data, true);
		echo json_encode($result);
	}
}