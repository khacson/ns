<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmployeefileModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function getSearch($search){
		$sql = "";
		if(!empty($search['code'])){
			$sql.= " and s.code = '".$search['code']."'";
		}
		if(!empty($search['identity'])){
			$sql.= " and s.identity = '".$search['identity']."'";
		}
		if(!empty($search['phone'])){
			$sql.= " and s.phone = '".$search['phone']."'";
		}
		return $sql;
	}
	function getList($search){ 
		$searchs = $this->getSearch($search);
		if(empty($searchs)){
			return $this->getNone();
		}
		$sql = "SELECT s.*
			FROM hre_employee AS s
			WHERE s.isdelete = 0 
			$searchs
			";
		$query = $this->model->query($sql)->execute(); 
		if(!empty($query[0]->id)){
			return $query[0];
		}
		else{
			return $this->getNone();
		}
	}
	function getNone(){
		$sql = "
			SELECT column_name, column_default
			FROM information_schema.columns
			WHERE table_name='hre_employee'; 
		";
		$query = $this->model->query($sql)->execute();
		$obj = new stdClass();
		foreach($query as $item){
			$clm = $item->column_name;
			$obj->$clm = $item->column_default;
		}
		return $obj;
	}
	function saves($array){
		$check = $this->model->table('hre_employee')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('code',$array['code'])
					  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		if($array['islogin'] == 1){//Tao tai khoan
			$insertUser = array();
			$passwords = '123456';
			$pass =  md5(md5($passwords."@SNK2017"));
			$password = $pass. md5('sonnk');  
			$insertUser['password'] = $password;
			$insertUser['departmentid'] = $array['departmentid'];
			$insertUser['username'] = $array['code'];
			$insertUser['fullname'] = $array['fullname'];
			$insertUser['branchid'] = $array['branchid'];
			$insertUser['email'] = $array['email'];
			$insertUser['phone'] = $array['phone'];
			$insertUser['usercreate'] = $array['usercreate'];
			$insertUser['datecreate'] = $array['datecreate'];
			$group = $this->model->table('hre_groups')
								 ->where('grouptype',4)
								 ->find();
			$insertUser['groupid'] = 0;
			if(!empty($group->id)){
				$insertUser['groupid'] = $group->id;
			}
			$this->model->table('hre_users')->insert($insertUser);
		}
		$result = $this->model->table('hre_employee')->insert($array);	
		return $result;
	}
	function edits($array,$id){
		 $check = $this->model->table('hre_employee')
		 ->select('id')
		 ->where('isdelete',0)
		 ->where('id <>',$id)
		 ->where('code',$array['code'])
		 ->find();
		 if(!empty($check->id)){
			 return -1;	
		 }
		 if($array['islogin'] == 1){//Tao tai khoan
			$insertUser = array();
			$passwords = '123456';
			$insertUser['departmentid'] = $array['departmentid'];
			$insertUser['fullname'] = $array['fullname'];
			$insertUser['branchid'] = $array['branchid'];
			$insertUser['email'] = $array['email'];
			$insertUser['phone'] = $array['phone'];
			$insertUser['usercreate'] = $array['usercreate'];
			$insertUser['datecreate'] = $array['datecreate'];
			$group = $this->model->table('hre_groups')
								 ->where('grouptype',4)
								 ->find();
			$insertUser['groupid'] = 0;
			if(!empty($group->id)){
				$insertUser['groupid'] = $group->id;
			}
			$this->model->table('hre_users')->where('username',$array['code'])->update($insertUser);
		}
		$result = $this->model->table('hre_employee')->save($id,$array);	
		return $result;
	 }
	function findID($code){
		 $query = $this->model->table('hre_employee')
					  ->select('*')
					  ->where('code',$code)
					  ->find();
		if(empty($query->id)){
			return $this->getNone();
		}
		return $query;
	 }
}