<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author 
 * @copyright 2015
 */
class Service extends CI_Controller {

    private $route;
    private $login;
	
    function __construct() {
        parent::__construct();
    }
    function _remap($method, $params = array()) {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        $this->_view();
    }
    function _view() {
		ob_clean();
        $objString = file_get_contents('php://input');   
		//$objString = '{"machine_sn":"1"}';
		$log = array();
		$log['logcheck'] = $objString;
		$log['timecheck'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);;
		$this->model->table('hre_log_check')->insert($log);
		
		$item = json_decode($objString); 
		if(!isset($item->id)){
			echo 'Not found employee'; exit;
		}
		$id = $item->id;
		$machine_sn = $item->machine_sn;
		$timecheck = date('Y-m-d H:i:s',strtotime($item->timecheck));
		$employee = $this->model->table('hre_employee')
								->select('id,branchid,departmentid')
								->where('code',$id)
								->find();
		if(empty($employee->id)){
			echo "Failed"; exit;
		}
		$insert = array();
		$insert['machine_sn'] = $machine_sn;
		$insert['datecheck'] = date('Y-m-d',strtotime($item->timecheck));
		$insert['employeeid'] = 0;
		$insert['departmentid'] = 0;
		$insert['branchid'] = 0;
		if(!empty($employee->id)){
			$insert['employeeid'] = $employee->id;
			$insert['departmentid'] = $employee->departmentid;
			$insert['branchid'] = $employee->branchid;
		}
		$checkEmp = $this->model->table('hre_timesheets')
								->select('id')
								->where('employeeid',$insert['employeeid'])
								->where('datecheck',$insert['datecheck'])
								->find();
		if(empty($checkEmp->id)){
			$insert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$insert['usercreate'] = $id;
			$insert['time_start'] = $timecheck;
			$this->model->table('hre_timesheets')->insert($insert);
		}
		else{
			$insert['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$insert['time_end'] = $timecheck;
			$this->model->table('hre_timesheets')->where('id',$checkEmp->id)->update($insert);
		}
		echo "Passed";
	}
	function polling(){
		ob_clean();
		$objString = file_get_contents('php://input');  
		//$objString = '{"machine_sn":"1"}';		
		$item = json_decode($objString);
		//S Insert log
		$insertLog = array();
		$insertLog['contents'] = $objString;
		$insertLog['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$this->model->table('hre_log')->insert($insertLog);
		//E Insert log
		
		if(!isset($item->machine_sn)){
			echo 'Not found machine'; exit;
		}
		$machine_sn = $item->machine_sn;
		$machine = $this->model
						->table('hre_machine')
						->where('machine_sn',$machine_sn)
						->where('isdelete',0)
						->find();
		if(empty($machine->id)){
			echo 'Not found machine'; exit;
		}
		if($machine->shutdown == 1){
			$arr = array();
			$arr['shutdown'] = 2;
			$arr['shutdown_date_sync'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$this->model->table('hre_machine')->where('id',$machine->id)->update($arr);
			$this->shutdown($machine_sn);
		}
		elseif($machine->restart == 1){
			$arr = array();
			$arr['restart'] = 2;
			$arr['restart_date_sync'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$this->model->table('hre_machine')->where('id',$machine->id)->update($arr);
			$this->restart($machine_sn);
		}
		elseif($machine->uploademployee == 1){
			$object = new stdClass();
			$object->result = "ok";
			$object->reponse = "uploademployee"; //restart
			$object->machine_sn = $machine_sn;
			
			$arr = array();
			$arr['uploademployee'] = 2;
			$arr['upload_date_sync'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$this->model->table('hre_machine')->where('id',$machine->id)->update($arr);
			echo json_encode($object); exit;
			//$this->uploadEmployee($machine_sn,$machine->id);
		}
		elseif($machine->downloademployee == 1){
			$this->downloademployee($machine_sn,$machine->id);
		}
		elseif($machine->deleteemployee == 1){
			$this->deleteemployee($machine_sn,$machine->id);
		}
		else{
			ob_clean();
			$object = new stdClass();
			$object->result = "no";
			$object->reponse = ""; 
			$object->machine_sn = $machine_sn;
			echo json_encode($object); exit;
		}
	}
	function uploadEmployee(){
		ob_clean();
		$objString = file_get_contents('php://input');  
		//$objString = '{"machine_sn":"1"}';		
		$item = json_decode($objString);
		$machine_sn = $item->machine_sn;
		if(count($item->data) > 0){
			$data = $item->data;
			foreach($data as $item){
				$employee_code = $item->id;
				$arrInsert = array();
				$arrInsert['employee_code'] = $employee_code;
				$arrInsert['fullname'] = $item->name;
				$arrInsert['password'] = $item->password;
				$arrInsert['privilege'] = $item->privilege;
				$arrInsert['enabled'] = $item->enabled;
				$arrInsert['version'] = $item->version;
				$arrInsert['Flag1'] = $item->Flag1;
				$arrInsert['TmpData1'] = $item->TmpData1;
				$arrInsert['TmpLength1'] = $item->TmpLength1;
				$arrInsert['Flag2'] = $item->Flag2;
				$arrInsert['TmpData2'] = $item->TmpData2;
				$arrInsert['TmpLength2'] = $item->TmpLength2;
				$checkEmployee = $this->model->table('hre_machine_fingerprint')
											 ->select('id')
											 ->where('isdelete',0)
											 ->where('employee_code',$employee_code)
											 ->limit(1)
											 ->find();
				if(empty($checkEmployee->id)){
					$arrInsert['usercreate'] = $machine_sn;
					$arrInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
					$this->model->table('hre_machine_fingerprint')->insert($arrInsert);
				}
				else{
					$arrInsert['dateupdate'] = $machine_sn;
					$arrInsert['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
					$this->model->table('hre_machine_fingerprint')
								->where('id',$checkEmployee->id)
								->update($arrInsert);
				}					
			}
		}
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "uploademployee"; //restart
		$object->machine_sn = $machine_sn;
	}
	function deleteemployee($machine_sn,$machineid){
		ob_clean();
		$query = $this->model->table('hre_machine_fingerprint')
							 ->select('*')
							 ->where('isdelete',1)
							 ->find_all();
		$array = array();
		foreach($query as $item){
			$obj =  new stdClass();
			$obj->id = $item->employee_code;
			$obj->name = $item->fullname;
			$obj->password = $item->password;
			$obj->privilege = $item->privilege;
			$obj->enabled = $item->enabled;
			$obj->version = $item->version;
			$obj->Flag1 = $item->Flag1;
			$obj->TmpData1 = $item->TmpData1;
			$obj->TmpLength1 = $item->TmpLength1;
			$obj->Flag2 = $item->Flag2;
			$obj->TmpData2 = $item->TmpData2;
			$obj->TmpLength2 = $item->TmpLength2;
			$array[] = $obj;
		}
		
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "deleteEmployee"; //downloadEmployee
		$object->machine_sn = $machine_sn;
		$object->data = $array;
		
		$arr = array();
		$arr['deleteemployee'] = 2;
		$arr['delete_date_sync'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$this->model->table('hre_machine')->where('id',$machineid)->update($arr);
		echo json_encode($object); exit;
	}
	function downloadEmployee($machine_sn,$machineid){
		ob_clean();
		$query = $this->model->table('hre_machine_fingerprint')
							 ->select('*')
							 ->where('isdelete',0)
							 ->find_all();
		$array = array();
		foreach($query as $item){
			$obj =  new stdClass();
			$obj->id = $item->employee_code;
			$obj->name = $item->fullname;
			$obj->password = $item->password;
			$obj->privilege = $item->privilege;
			$obj->enabled = $item->enabled;
			$obj->version = $item->version;
			$obj->Flag1 = $item->Flag1;
			$obj->TmpData1 = $item->TmpData1;
			$obj->TmpLength1 = $item->TmpLength1;
			$obj->Flag2 = $item->Flag2;
			$obj->TmpData2 = $item->TmpData2;
			$obj->TmpLength2 = $item->TmpLength2;
			$array[] = $obj;
		}
		
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "downloadEmployee"; //downloadEmployee
		$object->machine_sn = $machine_sn;
		$object->data = $array;
		
		$arr = array();
		$arr['downloademployee'] = 2;
		$arr['download_date_sync'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$this->model->table('hre_machine')->where('id',$machineid)->update($arr);
		echo json_encode($object); exit;
	}
	function restart($machine_sn){
		ob_clean();
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "restart"; //restart
		$object->machine_sn = $machine_sn;
		echo json_encode($object); exit;
	}
	function shutdown($machine_sn){
		ob_clean();
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "shutdown"; //shutdown
		$object->machine_sn = $machine_sn;
		echo json_encode($object); exit;
	}
	function getEmployee(){
		ob_clean();
		echo json_encode($object);	exit;			 
	}
}