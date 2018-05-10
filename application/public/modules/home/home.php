 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2017
 */

class Home extends CI_Controller {
    var $phonedetail;
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('base_model','login_model','excel_model'));
        $this->phonedetail = 'g_processdetail';
		$this->login = $this->site->getSession('glogin');
		$this->route = $this->router->class;
		$this->site->setTemplate('home');
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
        if (empty($login['id'])){
			redirect(base_url());
		}
	    $permission = $this->base_model->getPermission($this->login, $this->route);
        $data->routes = $this->route; 
        $data->groupid = $login['groupid'];
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
        $this->site->render();
    }
    public function loadWorkFlow(){
		$result = new stdClass();
        echo json_encode($result);
    }
    public function loadWorkFlowEdit(){
		$result = new stdClass();
        echo json_encode($result);
    }
}