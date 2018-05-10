<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2013
 */
class Authorize extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->route = $this->router->class;
		$this->load->model("base_model");
    }
    function _remap($method, $params = array()) {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        $this->_view();
    }
    function _view() {
		if(isset($_GET['obj'])){
			return $this->createSesion();
		}
        $this->site->setTemplate('login');
        $data = new stdClass();
        $login = $this->site->getSession("glogin");
		if(!empty($login['id'])){
			redirect(base_url().'dashboard');
		}
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
        $this->site->render();
    }
    function login() {
		$result = new stdClass();
		$this->load->model(array('base_model'));
        $username = strtolower(trim($this->input->post("email")));
		$captcha = md5(strtolower($this->input->post("captcha")));
		$captcha_shopfloor =  $this->site->GetSession("captcha_shopfloor");
		$p = $this->input->post("password");
		
		$pass =  md5(md5($p."@SNK2017"));
		$password = $pass. md5('sonnk');  
		$datecreate = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		if($captcha != $captcha_shopfloor){
			$result->status = 0;
			echo json_encode($result); exit;
		}
		$sql = "
			SELECT u.id, u.departmentid , u.signatures, u.username , u.groupid, u.avatar , u.fullname, u.supplierid, u.processid,u.processid as listprocessid , u.email, u.phone, g.groupname, g.isadmin, g.params, g.grouptype, g.companyid, u.branchid, u.approved_leave, u.approved_overtime, u.approved_recruitment
			FROM hre_users u
			LEFT JOIN hre_groups g on g.id = u.groupid
			WHERE u.isdelete = 0
			AND g.isdelete = 0
			and u.activate = 1
			AND u.`password` = '$password'
			AND u.username = '$username' 
			;
		";
		$query = $this->model->query($sql)->execute();
		$result = new stdClass();
		if(!empty($query[0]->id)){
			$this->createAction($query[0],$query[0]->username);
		}
		else{
			$result->status = 0;
			echo json_encode($result);
			exit;
		}
    }
	function createAction($query,$userlogin){
		$result = new stdClass();
		$login = (array)$query;
		#region set Ctrl
		$sql = "
			SELECT m.id, m.route, m.processid
				FROM hre_menus m
				where m.isdelete = 0
				;
		";
		$querys = $this->model->query($sql)->execute();
		//get empployee
		$employee = $this->model->table('hre_employee')
								->select('id as employeeid, positionid')
								->where('code',$userlogin)
								->where('isdelete',0)
								->find();
		$listMenu = array();
		foreach($querys as $item){
			$listMenu[$item->id] = $item->route;
		}
		$params = json_decode($login['params'],true);
		$arr_params = array();
		foreach($params as $key=>$val){
			if(isset($listMenu[$key])){
				$arr_params[$listMenu[$key]] = $val;
			}
		}
		#end
		$login['employee'] = (array)$employee;
		$login['userlogin'] = $userlogin;
		$login['params'] = $arr_params;
		$this->getLanguageList($query->companyid);
		$config = $this->getConfig($query->companyid);
		$this->site->SetSession('config',$config);
		$this->site->SetSession('glogin',$login);
		$info = $this->getBranch($query->companyid,$query->branchid);
		$this->site->SetSession('info',$info);
		$ctrol = 'Thành viên';
		$func =  'Login';
		$this->base_model->addAcction($ctrol,$func,$acction_before='',$action_after='');
		
		$result->status = 1;
		echo json_encode($result);
		exit;
	}
	function getConfig($companyid){
		$query = $this->model->table('hre_config')
							 ->where('isdelete',0)
							 ->where('companyid',$companyid)
							 ->find();	
		return $query;
	}
	function getBranch($companyid,$branchid){
		$branch = $this->model->table('hre_branch')
							 ->where('isdelete',0)
							 ->where('id',$branchid)
							 ->find();	
		$arr = array();
		$arr['branch_name'] = '';
		if(!empty($branch->branch_name)){
			$arr['branch_name'] = $branch->branch_name;
		}
		$arr['phone'] = '';
		if(!empty($branch->phone)){
			$arr['phone'] = $branch->phone;
		}
		$arr['address'] = '';
		if(!empty($branch->address)){
			$arr['address'] = $branch->address;
		}
		$company = $this->model->table('hre_company')
							 ->where('isdelete',0)
							 ->where('id',$companyid)
							 ->find(); 
		$arrCom = array();
		$arrCom['company_name'] = '';
		if(!empty($company->company_name)){
			$arrCom['company_name'] = $company->company_name;
		}
		$arrCom['phone'] = '';
		if(!empty($company->phone)){
			$arrCom['phone'] = $company->phone;
		}
		$arrCom['address'] = '';
		if(!empty($company->address)){
			$arrCom['address'] = $company->address;
		}
		$arrCom['logo'] = '';
		if(!empty($company->logo)){
			$arrCom['logo'] = $company->logo;
		}
		return array('branch'=>$arr,'company'=>$arrCom);
	}
	function getLanguageList($companyid){
		$tb = $this->base_model->loadTable();
		$langDefault = 'vn';
		$query = $this->model->table('hre_translate')
							 ->select('keyword,translation')
							 ->where('isdelete',0)
							 ->where('langkey',$langDefault)
							 ->find_all();
		$array = array();
		foreach($query as $item){
			$array[$item->keyword] = $item->translation;
		}
		$this->site->SetSession('language',$array);
		return $array;
	}
    function logout(){
		//$login = $this->site->getSession("glogin");
		$ctrol = 'Thành viên';
		$func =  'Logout';
		$this->base_model->addAcction($ctrol,$func,$acction_before='',$action_after='');
		
		$this->site->SetSession('glogin',array());
        $this->site->deleteSession("glogin");
		redirect(base_url());
    }
	function captcha(){
        $captcha = $this->site->createCapcha('captcha_shopfloor');   
    }
}