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
	function syncFingerprint(){
		ob_clean();
        $objString = file_get_contents('php://input');
		//$objString =  '{"machine_sn":1,"data":[{"id":"1","timecheck":"2018-03-10 15:09:54"}]}';
		//S Insert log
		$insertLog = array();
		$insertLog['contents'] = $objString;
		$insertLog['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$this->model->table('hre_log')->insert($insertLog);
		//E Insert log
		$item = json_decode($objString); 
		if(!isset($item->machine_sn)){
			echo 'Not found machine sn'; exit;
		}	
		$data = $item->data;
		$machine_sn = $item->machine_sn;
		foreach($data as $items){
			$id = $items->id;
			//S Dong bo
			$timecheck = date('Y-m-d H:i:s',strtotime($items->timecheck));
			$employee = $this->model->table('hre_employee')
									->select('id,branchid,departmentid')
									->where('code',$id)
									->find();
			if(empty($employee->id)){
				continue;
			}
			//Service
			$datecheck = date('Y-m-d',strtotime($timecheck));
			$checkEmp = $this->model->table('hre_timesheets')
								->select('id')
								->where('employeeid',$employee->id)
								->where('datecheck',$datecheck)
								->find();
			
			$insert = array();
			$insert['machine_sn'] = $machine_sn;
			$insert['datecheck'] = $datecheck;
			$insert['employeeid'] = $employee->id;
			$insert['departmentid'] = $employee->departmentid;
			$insert['branchid'] = $employee->branchid;
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
			//E Dong bo
		}
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "syncFingerprint"; //delete_file
		$object->machine_sn = $machine_sn;
		echo json_encode($object); exit;
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
			$object->link_service = base_url().'uploademployee';
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
		if($machine->delete_file == 1){
			$arr = array();
			$arr['delete_file '] = 2;
			$arr['delete_file_date_sync'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$this->model->table('hre_machine')->where('id',$machine->id)->update($arr);
			//ECho
			$object = new stdClass();
			$object->result = "ok";
			$object->reponse = "deletefile"; //delete_file
			$object->machine_sn = $machine_sn;
			echo json_encode($object); exit;
		}
		if($machine->fingerprint == 1){
			$arr = array();
			$arr['fingerprint'] = 2;
			$arr['fingerprint_date_sync'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$this->model->table('hre_machine')->where('id',$machine->id)->update($arr);
			//ECho
			$object = new stdClass();
			$object->result = "ok";
			$object->reponse = "fingerprint"; //delete_file
			$object->fromdate = $machine->fingerprint_date_from;
			$object->todate = $machine->fingerprint_date_to; 
			$object->machine_sn = $machine_sn;
			$object->link_service = base_url().'syncFingerprint';
			echo json_encode($object); exit;
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
		//S Insert log
		$insertLog = array();
		$insertLog['contents'] = 'Upload:'.$objString;
		$insertLog['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$this->model->table('hre_log')->insert($insertLog);
		//E Insert log
		$item = json_decode($objString);
		if(empty($item->machine_sn)){
			echo 'Not found machine'; exit;
		}
		$machine_sn = $item->machine_sn; //machine_sn
		if(count($item->data) > 0){
			$data = $item->data;
			foreach($data as $item){
				$employee_code = $item->id;
				$arrInsert = array();
				$arrInsert['code'] = $employee_code;
				$arrInsert['fullname'] = $item->name;
				if(isset($item->password)){
					$arrInsert['print_password'] = $item->password;
				}
				if(isset($item->privilege)){
					$arrInsert['print_privilege'] = $item->privilege;
				}
				if(isset($item->enabled)){
					$arrInsert['print_enabled'] = $item->enabled;
				}
				if(isset($item->version)){
					$arrInsert['print_version'] = $item->version;
				}
				if(isset($item->Flag1)){
					$arrInsert['print_Flag1'] = $item->Flag1;
				}
				if(isset($item->TmpData1)){
					$arrInsert['print_TmpData1'] = $item->TmpData1; //TmpData1
				}
				if(isset($item->TmpLength1)){
					$arrInsert['print_TmpLength1'] = $item->TmpLength1;
				}
				if(isset($item->Flag2)){
					$arrInsert['print_Flag2'] = $item->Flag2;
				}
				if(isset($item->TmpData2)){
					$arrInsert['print_TmpData2'] = $item->TmpData2;
				}
				if(isset($item->TmpLength2)){
					$arrInsert['print_TmpLength2'] = $item->TmpLength2;
				}
				$checkEmployee = $this->model->table('hre_employee')
											 ->select('id')
											 ->where('isdelete',0)
											 ->where('code',$employee_code)
											 ->limit(1)
											 ->find();
				if(empty($checkEmployee->id)){
					$arrInsert['usercreate'] = $machine_sn;
					$arrInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
					$this->model->table('hre_employee')->insert($arrInsert);
				}
				else{
					$arrInsert['dateupdate'] = $machine_sn;
					$arrInsert['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
					$this->model->table('hre_employee')
								->where('id',$checkEmployee->id)
								->update($arrInsert);
				}					
			}
		}
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "uploademployee"; //restart
		$object->machine_sn = $machine_sn;
		echo json_encode($object); exit;
	}
	function deleteemployee($machine_sn,$machineid){
		ob_clean();
		$query = $this->model->table('hre_employee')
							 ->select('*')
							 ->where('isdelete',1)
							 ->find_all();
		$array = array();
		foreach($query as $item){
			//$obj =  new stdClass();
			//$obj->id = $item->code;
			/*$obj->name = $item->fullname;
			$obj->password = $item->print_password;
			$obj->privilege = $item->print_privilege;
			$obj->enabled = $item->print_enabled;
			$obj->version = $item->print_version;
			$obj->Flag1 = $item->print_Flag1;
			$obj->TmpData1 = $item->print_TmpData1;
			$obj->TmpLength1 = $item->print_TmpLength1;
			$obj->Flag2 = $item->print_Flag2;
			$obj->TmpData2 = $item->print_TmpData2;
			$obj->TmpLength2 = $item->print_TmpLength2;*/
			$array[] = $item->code;
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
	function downloadEmployee($machine_sn='0',$machineid='0'){
		//$machine_sn = '1';
		//$machineid = '1';
		ob_clean();
		$findList = $this->model->table('hre_employee_sync')
							  ->select(' group_concat(employee_id) listid')
							  ->where('machine_id',$machineid)
							  ->find();
		$listid = 0;
		if(!empty($findList->listid)){
			$listid = $findList->listid;
		}
		
		$query = $this->model->table('hre_employee')
							 ->select('id,code,fullname,print_password,print_privilege,print_enabled,print_version,print_Flag1,print_TmpData1,print_TmpLength1,print_Flag2,print_TmpData2,print_TmpLength2')
							 ->where('isdelete',0)
							 ->where("code not in($listid)")
							 ->limit(20)
							 ->find_all(); 
		//echo '<pre>'; print_r($query ); exit;
		$array = array();
		foreach($query as $item){
			$obj =  new stdClass();
			$obj->id = $item->code;
			$obj->name = $item->fullname;
			if(!empty( $item->print_password)){
				$obj->password = $item->print_password;
			}
			if(!empty( $item->print_privilege)){
				$obj->privilege = $item->print_privilege;
			}
			if(!empty( $item->print_enabled)){
				$obj->enabled = $item->print_enabled;
				if( $item->print_enabled == 1){
					$obj->enabled =  true;
				}
				elseif( $item->print_enabled == 0){
					$obj->enabled =  false;
				}
			}
			if(!empty( $item->print_version)){
				$obj->version = $item->print_version;
			}
			if(!empty( $item->print_Flag1)){
				$obj->Flag1 = $item->print_Flag1;
			}
			if(!empty( $item->print_TmpData1)){
				$obj->TmpData1 = $item->print_TmpData1;
			}
			if(!empty( $item->print_TmpLength1)){
				$obj->TmpLength1 = $item->print_TmpLength1;
			}
			if(!empty( $item->print_Flag2)){
				$obj->Flag2 = $item->print_Flag2;
			}
			if(!empty( $item->print_TmpData2)){
				$obj->TmpData2 = $item->print_TmpData2;
			}
			if(!empty( $item->print_TmpLength2)){
				$obj->TmpLength2 = $item->print_TmpLength2;
			}
			$array[] = $obj;
		}
		
		$object = new stdClass();
		$object->result = "ok";
		$object->reponse = "downloadEmployee"; //downloadEmployee
		$object->machine_sn = $machine_sn;
		$object->data = $array;
		$time = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		if(count($query) == 0){
			$arr = array();
			$arr['downloademployee'] = 2;
			$arr['download_date_sync'] = $time;
			$this->model->table('hre_machine')->where('id',$machineid)->update($arr);
		}
		/*
		else{//Insert ID đã gửi
			foreach($query as $item){
				$insertLog = array();
				$insertLog['employee_id'] = $item->id;
				$insertLog['machine_id'] = $machineid;
				$insertLog['date_sync'] =  $time;
				$this->model->table('hre_employee_sync')->insert($insertLog);
			}
		}*/
		echo json_encode($object); exit;
	}
	function cfdownloadEmployee(){
		ob_clean();
		$objString = file_get_contents('php://input');  
		/*$objString = '{"result":"ok","reponse":"cfdownloadEmployee","machine_sn":"1","data":[2,8951,8000,8001,8002,8003,8004,8005,8006,8007,8008,1,8959,9988]}';*/
		//S Insert log
		$insertLog = array();
		$insertLog['contents'] = 'cfdownload:'.$objString;
		$insertLog['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$this->model->table('hre_log')->insert($insertLog);
		//E Insert log
		$item = json_decode($objString);
		if(empty($item->machine_sn)){
			echo 'Not found machine'; exit;
		} 
		if(!empty($item->data)){
			$machine_sn = $item->machine_sn;
			$machine = $this->model->table('hre_machine')
							->select('id')
							->where('machine_sn',$machine_sn)
							->where('isdelete',0)
							->find();
			$machineid = $machine->id;
			$datas = $item->data;
			$time = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			foreach($datas as $key => $id){
				$insertLog = array();
				$insertLog['employee_id'] = $id;
				$insertLog['machine_id'] = $machineid;
				$insertLog['date_sync'] =  $time;
				$this->model->table('hre_employee_sync')->insert($insertLog);
			}
			$object = new stdClass();
			$object->result = "ok";
			$object->reponse = "cfdownloadEmployee"; 
			$object->machine_sn = $machine_sn;
			echo json_encode($object); exit;
		}
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