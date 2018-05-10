 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Kpiemployee extends CI_Controller {
    var $phonedetail;
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('login_model','base_model'));
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
		$data->permission = $permission;
        $data->routes = $this->route; 
        $data->groupid = $login['groupid'];
		#gegion add log
		$ctrol = getLanguage('cham-diem-kpi-nhan-vien');
		$func =  getLanguage('xem');
		$this->base_model->addAcction($ctrol,$func,'','');
		#end	
		$data->montNow = $year = gmdate("m/Y", time() + 7 * 3600);
		$data->departments = $this->base_model->getDepartment($login['departmentid']);
		$data->months = $this->model->getMonth();
		$kpis = $this->base_model->getKPI();
		$data->totalkpi = count($kpis);
		
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
        $this->site->render();
    }
	function form(){
		$login = $this->login;
		$id = $this->input->post('id');
		$monthid = $this->input->post('monthid');
		$departmentid = $this->input->post('departmentid');
		$employeeid = $id;
		$find = $this->model->findID($id);
		if(empty($find->id)){
			$find = $this->base_model->getColumns('hre_employee');
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		if(empty($id)){
			$result->title = getLanguage('cham-diem');
		}
		else{
			$result->title = getLanguage('sua');
		}
		$data->departmentid = $departmentid;
		$data->employeeid = $employeeid;
		$data->monthid = $monthid;
		$data->montNow = $year = gmdate("m/Y", time() + 7 * 3600);
		$data->months = $this->model->getMonth();
		$data->kpis = $this->base_model->getKPI();
		$findKPI = $this->model->getKPI($monthid,$employeeid);
		$data->kpiemployee = array();
		if(isset($findKPI[$employeeid])){
			$data->kpiemployee = $findKPI[$employeeid];
		}
		$data->employees = $this->base_model->getEmployees($login);
		$data->departments = $this->base_model->getDepartment($login['departmentid']);
		$data->branchid = $login['branchid'];
        $result->content = $this->load->view('form', $data, true);
		$result->id = $id;
        echo json_encode($result);
	}
	function getList(){
		$rows = 20; //$this->site->config['row'];
		$page = $this->input->post('page');
        $pageStart = $page * $rows;
        $rowEnd = ($page + 1) * $rows;
		$start = empty($page) ? 1 : $page+1;
		$searchs = json_decode($this->input->post('search'),true);
		$searchs['order'] = substr($this->input->post('order'),4);
		$searchs['index'] = $this->input->post('index');
		$data = new stdClass();
		$result = new stdClass();
		$datas = $this->model->getList($searchs,$page,$rows);
		$count = $this->model->getTotal($searchs);
		$data->datas = $datas;
		$data->start = $start;
		$data->permission = $this->base_model->getPermission($this->login, $this->route);
		$searchmonth = $searchs['month'];
		
		$data->kpis = $this->base_model->getKPI();
		$data->totalkpi = count($data->kpis);
		$data->findKPI = $this->model->getKPI($searchs['month']); 
		//$data->arr_thu = $arr_thu;
		//$data->arrayDate = $arrayDate;
		$page_view=$this->site->pagination($count,$rows,5,$this->route,$page);
		$result->paging = $page_view;
		$result->csrfHash = $this->security->get_csrf_hash();
		$result->viewtotal = number_format($count); 
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
        $login = $this->login;
        $array['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
        $array['usercreate'] = $login['userlogin'];
        $result['status'] = $this->model->saves($array);
		#region logfile
		$ctrol = getLanguage('cham-diem-kpi-nhan-vien');
		$func =  getLanguage('them-moi').': '.$array['employeeid'];
		$this->base_model->addAcction($ctrol,$func,'','');	
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
		$ctrol = getLanguage('cham-diem-kpi-nhan-vien');
		$func =  getLanguage('xoa').': '.$findID->code;
		$this->base_model->addAcction($ctrol,$func,json_encode($findID),'');	
		#end
        echo json_encode($result);
    }
	function getEmployee(){
		$login = $this->login;
		$departmentid = $this->input->post('departmentid');
		$employees = $this->base_model->getEmployees($login,$departmentid);
		$html = '<select id="input_employeeid" class="form-control form-input select2me" name="input_employeeid" data-placeholder="'.getLanguage('chon-nhan-vien').'"><option value=""></option>';
		foreach($employees as $item){
			$html.= '<option value="'.$item->id .'">'.$item->code .'- '.$item->fullname .'</option>';
		}
		$html.= '</select>';
		echo $html;
	}
}