 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Employeefile extends CI_Controller {
    var $phonedetail;
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('login_model','base_model','excel_model'));
        $this->phonedetail = 'hre_processdetail';
		$this->login = $this->site->getSession('glogin');
		$this->route = $this->router->class;
		//$this->load->library('employeefile');
		$this->site->setTemplate('close');
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
		$code = 0;
		if(isset($_GET['code'])){
			$code = $_GET['code'];
		}
		$data->permission = $permission;
        $data->routes = $this->route; 
        $data->groupid = $login['groupid'];
		$data->code = $code;
		$data->finds = $this->model->findID($code);
		#gegion add log
		$ctrol = getLanguage('ho-so-nhan-vien');
		$func =  getLanguage('xem');
		$this->base_model->addAcction($ctrol,$func,'','');
		#end	
		$data->csrfName = '';
		$data->csrfHash = '';
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
        $this->site->render();
    }
	function form(){
		$login = $this->login;
		$id = $this->input->post('id');
		$find = $this->model->findID($id);
		if(empty($find->id)){
			$find = $this->base_model->getColumns('hre_ethnic');
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		if(empty($id)){
			$result->title = getLanguage('them-moi');
		}
		else{
			$result->title = getLanguage('sua');
		}
		$data->branchid = $login['branchid'];
        $result->content = $this->load->view('form', $data, true);
		$result->id = $id;
        echo json_encode($result);
	}
    function getList(){
		if(!isset($_POST['csrf_stock_name'])){
			//show_404();
		}
		$login = $this->login;
		$rows = 20; //$this->site->config['row'];
		$page = $this->input->post('page');
        $pageStart = $page * $rows;
        $rowEnd = ($page + 1) * $rows;
		$start = empty($page) ? 1 : $page+1;
		$searchs = json_decode($this->input->post('search'),true);
		$code = $this->input->post('code');
		$searchs['code'] = $code;
		//$searchs['order'] = substr($this->input->post('order'),4);
		//$searchs['index'] = $this->input->post('index');
		$data = new stdClass();
		$result = new stdClass();
		$query = $this->model->getList($searchs); 
		$data->datas = $query;
		//$data->start = $start; datas
		//$data->finds = $this->model->findID($code);
		$data->routes = $this->route;
		$data->csrfName = $this->security->get_csrf_token_name();
		$data->csrfHash = $this->security->get_csrf_hash();		
		$data->permission = $this->base_model->getPermission($this->login, $this->route);
		$data->provinces = $this->base_model->getProvince();
		$data->districs = $this->base_model->getDistric('');	
		$data->ethnics = $this->base_model->getEthnic('');	
		$data->religions = $this->base_model->getReligion('');	
		$data->academics = $this->base_model->getAcademic('');
		$data->departments = $this->base_model->getDepartment('');
		$data->positions = $this->base_model->getPosition('');
		$data->jobstatus = $this->base_model->getJobStatus('');
		$data->shifts = $this->base_model->getShift($login['branchid']);
		$data->departmentGroups = $this->base_model->getDepartmentGroup($query->departmentid);
		if(!empty($query->permanent_province)){
			$data->districs = $this->base_model->getDistric($query->permanent_province);			
		}
		else{
			$data->districs = array();	
		}
		if(!empty($query->tempery_province)){
			$data->districs2 = $this->base_model->getDistric($query->tempery_province);			
		}
		else{
			$data->districs2 = array();	
		}
		if(!empty($query->id)){
			$result->status = 1;
		}
		else{
			$tt = 0;
			foreach($searchs as $k=>$v){
				if(!empty($v)){
					$tt+= 1;
				}
			}
			if($tt > 0){
				$result->status = 0;
			}
			else{
				$result->status = 1;
			}
		}
		$result->paging = "";//$page_view;
		$result->csrfHash = $this->security->get_csrf_hash();
		$result->viewtotal = 0;//number_format($count); 
        $result->content = $this->load->view('list', $data, true);
		echo json_encode($result);
	}
	function save() {
		$token =  $this->security->get_csrf_hash();
		$array = json_decode($this->input->post('search'),true);
		$array['islogin'] = $this->input->post('islogin');
		unset($array['s2id_sex']);
		unset($array['s2id_marriage']);
		unset($array['s2id_nationality']);
		unset($array['s2id_ethnicid']);
		unset($array['s2id_religionid']);
		unset($array['s2id_identity_from']);
		unset($array['s2id_academic_level']);
		unset($array['s2id_permanent_province']);
		unset($array['s2id_tempery_province']);
		unset($array['s2id_tempery_distric']);
		unset($array['s2id_permanent_province']);
		unset($array['s2id_departmentid']);
		unset($array['s2id_positionid']);
		unset($array['s2id_jobstatusid']);
		unset($array['s2id_permanent_dictric']);
		unset($array['s2id_group_work_id']);
		unset($array['s2id_shiftid']);
		$ht_time = '{'.substr($this->input->post('ht_time'),1).'}';
		$ht_time = str_replace("'","___",$ht_time);
		$ht_school = '{'.substr($this->input->post('ht_school'),1).'}';
		$ht_school = str_replace("'","___",$ht_school);
		$ht_adress = '{'.substr($this->input->post('ht_adress'),1).'}';
		$ht_adress = str_replace("'","___",$ht_adress);
		
		$obj_ht_time = json_decode($ht_time);
		$obj_ht_school = json_decode($ht_school); 
		$obj_ht_adress = json_decode($ht_adress);
		$arr_ht = array();
		if(count($obj_ht_time) > 0){
			$arr1 = array();
			foreach($obj_ht_time as $k1=>$v1){
				$arr1[$k1] = $v1;
			}
			$arr_ht[] = $arr1;
			$arr2 = array();
			foreach($obj_ht_school as $k2=>$v2){
				$arr2[$k2] = $v2;
			}
			$arr_ht[] = $arr2;
			$arr3 = array();
			foreach($obj_ht_adress as $k3=>$v3){
				$arr3[$k3] = $v3;
			}
			$arr_ht[] = $arr3;
		}
		$array['study_process']  = json_encode($arr_ht);
		
		$work_time = '{'.substr($this->input->post('work_time'),1).'}';
		$work_time = str_replace("'","___",$work_time);
		$work_company = '{'.substr($this->input->post('work_company'),1).'}';
		$work_company = str_replace("'","___",$work_company);
		$work_address = '{'.substr($this->input->post('work_address'),1).'}';
		$work_address = str_replace("'","___",$work_address);
		
		$obj_work_time= json_decode($work_time);
		$obj_work_company = json_decode($work_company); 
		$obj_work_address = json_decode($work_address);
		
		$arr_work = array();
		if(count($obj_work_time) > 0){
			$arr1 = array();
			foreach($obj_work_time as $k1=>$v1){
				$arr1[$k1] = $v1;
			}
			$arr_work[] = $arr1;
			$arr2 = array();
			foreach($obj_work_company as $k2=>$v2){
				$arr2[$k2] = $v2;
			}
			$arr_work[] = $arr2;
			$arr3 = array();
			foreach($obj_work_address as $k3=>$v3){
				$arr3[$k3] = $v3;
			}
			$arr_work[] = $arr3;
		}
		$array['working_process']  = json_encode($arr_work);
		$login = $this->login;
		if(!empty($array['birthday'])){
			$array['birthday'] = fmDateSave($array['birthday']);
		}
		if(!empty($array['identity_date'])){
			$array['identity_date'] = fmDateSave($array['identity_date']);
		}
		if(!empty($array['date_start'])){
			$array['date_start'] = fmDateSave($array['date_start']);
		}
		if(!empty($array['contrac_date'])){
			$array['contrac_date'] = fmDateSave($array['contrac_date']);
		}
		if(!empty($array['contac_expired_date'])){
			$array['contac_expired_date'] = fmDateSave($array['contac_expired_date']);
		}
		$array['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['usercreate'] = $login['username'];
		$array['branchid'] = $login['branchid'];
		$result['status'] =$this->model->saves($array);
		$this->base_model->addAcction($this->route,$this->uri->segment(2),'',json_encode($result));
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	function edit() {
		$token =  $this->security->get_csrf_hash();
		$array = json_decode($this->input->post('search'),true);
		$array['islogin'] = $this->input->post('islogin');
		unset($array['s2id_sex']);
		unset($array['s2id_marriage']);
		unset($array['s2id_nationality']);
		unset($array['s2id_ethnicid']);
		unset($array['s2id_religionid']);
		unset($array['s2id_identity_from']);
		unset($array['s2id_academic_level']);
		unset($array['s2id_permanent_province']);
		unset($array['s2id_tempery_province']);
		unset($array['s2id_tempery_distric']);
		unset($array['s2id_permanent_province']);
		unset($array['s2id_departmentid']);
		unset($array['s2id_positionid']);
		unset($array['s2id_jobstatusid']);
		unset($array['s2id_permanent_dictric']);
		unset($array['s2id_group_work_id']);
		unset($array['s2id_shiftid']);
		$id = $this->input->post('id');
		$ht_time = '{'.substr($this->input->post('ht_time'),1).'}';
		$ht_time = str_replace("'","___",$ht_time);
		$ht_school = '{'.substr($this->input->post('ht_school'),1).'}';
		$ht_school = str_replace("'","___",$ht_school);
		$ht_adress = '{'.substr($this->input->post('ht_adress'),1).'}';
		$ht_adress = str_replace("'","___",$ht_adress);
		
		$obj_ht_time = json_decode($ht_time);
		$obj_ht_school = json_decode($ht_school); 
		$obj_ht_adress = json_decode($ht_adress);
		$arr_ht = array();
		if(count($obj_ht_time) > 0){
			$arr1 = array();
			foreach($obj_ht_time as $k1=>$v1){
				$arr1[$k1] = $v1;
			}
			$arr_ht[] = $arr1;
			$arr2 = array();
			foreach($obj_ht_school as $k2=>$v2){
				$arr2[$k2] = $v2;
			}
			$arr_ht[] = $arr2;
			$arr3 = array();
			foreach($obj_ht_adress as $k3=>$v3){
				$arr3[$k3] = $v3;
			}
			$arr_ht[] = $arr3;
		}
		$array['study_process']  = json_encode($arr_ht);
		
		$work_time = '{'.substr($this->input->post('work_time'),1).'}';
		$work_time = str_replace("'","___",$work_time);
		$work_company = '{'.substr($this->input->post('work_company'),1).'}';
		$work_company = str_replace("'","___",$work_company);
		$work_address = '{'.substr($this->input->post('work_address'),1).'}';
		$work_address = str_replace("'","___",$work_address);
		
		$obj_work_time= json_decode($work_time);
		$obj_work_company = json_decode($work_company); 
		$obj_work_address = json_decode($work_address);
		
		$arr_work = array();
		if(count($obj_work_time) > 0){
			$arr1 = array();
			foreach($obj_work_time as $k1=>$v1){
				$arr1[$k1] = $v1;
			}
			$arr_work[] = $arr1;
			$arr2 = array();
			foreach($obj_work_company as $k2=>$v2){
				$arr2[$k2] = $v2;
			}
			$arr_work[] = $arr2;
			$arr3 = array();
			foreach($obj_work_address as $k3=>$v3){
				$arr3[$k3] = $v3;
			}
			$arr_work[] = $arr3;
		}
		$array['working_process']  = json_encode($arr_work);
		$login = $this->login; 
		if(!empty($array['birthday'])){
			$array['birthday'] = fmDateSave($array['birthday']);
		}
		if(!empty($array['identity_date'])){
			$array['identity_date'] = fmDateSave($array['identity_date']);
		}
		if(!empty($array['date_start'])){
			$array['date_start'] = fmDateSave($array['date_start']);
		}
		if(!empty($array['contrac_date'])){
			$array['contrac_date'] = fmDateSave($array['contrac_date']);
		}
		if(!empty($array['contac_expired_date'])){
			$array['contac_expired_date'] = fmDateSave($array['contac_expired_date']);
		}
		$array['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['usercreate'] = $login['username'];
		$array['branchid'] = $login['branchid'];
		$result['status'] =$this->model->edits($array,$id);
		$this->base_model->addAcction($this->route,$this->uri->segment(2),'',json_encode($result));
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	function getgetDepartmentGroup(){
		$departmentid = $this->input->post('departmentid');
		$query = $this->base_model->getDepartmentGroup($departmentid);
		$html = '';
		$html.= "<select class='form-control select2me' id='group_work_id' name='group_work_id' data-placeholder='".getLanguage('chon-to-nhom')."'><option value=''></option>";
		foreach($query as $item){
			$html.= '<option value="'.$item->id .'">'.$item->departmentgroup_name .'</option>';
		}
		$html.= '</select>';
		echo $html;
	}
	function getDistric(){
		$provinceid = $this->input->post('provinceid');
		$districs = $this->base_model->getDistric($provinceid);				
		$html = '<select id="permanent_dictric" class="form-control select2me" name="permanent_dictric" data-placeholder="'.getLanguage('chon-to-nhom').'"><option value=""></option>';
		foreach($districs as $item){
			$html.= '<option value="'.$item->id .'">'.$item->distric_name .'</option>';
		}
		$html.= '</select>';
		echo $html;
	}
	function getDistric2(){
		$provinceid = $this->input->post('provinceid');
		$districs = $this->base_model->getDistric($provinceid);				
		$html = '<select id="tempery_distric" class="form-control select2me" name="tempery_distric"  data-placeholder="'.getLanguage('chon-quan-huyen').'"><option value=""></option>';
		foreach($districs as $item){
			$html.= '<option value="'.$item->id .'">'.$item->distric_name .'</option>';
		}
		$html.= '</select>';
		echo $html;
	}
}