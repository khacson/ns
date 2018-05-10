<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class UserModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_users')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	public function getallGroup($companyid) {
		$grouptype = $this->login['grouptype'];
			$sql = " SELECT id, groupname, parentid ,grouptype 
			FROM hre_groups AS g
			WHERE g.isdelete = 0";
		if(!empty($companyid)){
			$sql.= " and g.companyid = '$companyid' ";	
		}
		if($grouptype > -1){
			$sql.= " and g.grouptype > -1 ";	
		}
		$sql.=	" ORDER BY groupname ASC ";
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getSearch($search){
		$sql = "";
		$grouptype = $this->login['grouptype'];
		if($search['activate'] != ""){
			$sql.= " and u.activate = '".$search['activate']."' ";	
		}
		if(!empty($search['email'])){
			$sql.= " and u.email like '%".$search['email']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and u.phone like '%".$search['phone']."%' ";	
		}
		if($search['groupid'] != ""){
			$sql.= " and u.groupid = '".$search['groupid']."' ";	
		}
		if($grouptype >= 0){//Manager
			$sql.= " and g.grouptype >= 0 ";	
		}
		elseif($grouptype > 0){//User
			$sql.= " and u.id = '".$this->login['id']."' ";	
		}
		if(!empty($this->login['branchid'])){
			$sql.= " and u.branchid = '".$this->login['branchid']."' ";	
		}
		if(!empty($this->login['companyid'])){
			$sql.= " and g.companyid = '".$this->login['companyid']."' ";	
		}
		if(!empty($this->login['departmentid'])){
			$sql.= " and u.departmentid = '".$this->login['departmentid']."' ";	
		}
		else{
			if(!empty($search['departmentid'])){
				$sql.= " and u.departmentid in (".$search['departmentid'].") ";	
			}
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " SELECT u.*, g.groupname, br.branch_name, d.departmanet_name
				FROM hre_users AS u
				LEFT JOIN hre_groups g on g.id = u.groupid
				LEFT JOIN `hre_branch` br on br.id = u.branchid and br.isdelete = 0
				LEFT JOIN `hre_department` d on d.id = u.departmentid and d.isdelete = 0
				WHERE u.isdelete = 0 
				and g.isdelete = 0
				$searchs
				ORDER BY u.fullname ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM hre_users AS u
			LEFT JOIN hre_groups g on g.id = u.groupid
			LEFT JOIN `hre_branch` br on br.id = u.branchid
			WHERE u.isdelete = 0
			and g.isdelete = 0
			and br.isdelete = 0
			
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
			$check = $this->model->table('hre_users')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('username',$array['username'])
				  ->find();
			if(!empty($check->id)){
				return -1;	
			}
		 $pass =  md5(md5($array['password']."@SNK2017"));
		 if(!empty($this->login['departmentid'])){
			$array['departmentid'] = $this->login['departmentid'];
		 }
		 $password = $pass. md5('sonnk');  
		 $array['password'] = $password;
		 unset($array['cfpassword']);
		 $result = $this->model->table('hre_users')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$check = $this->model->table('hre_users')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('username',$array['username'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		if(!empty($this->login['departmentid'])){
			$array['departmentid'] = $this->login['departmentid'];
		 }
		if(!empty($array['password'])){
			$pass =  md5(md5($array['password']."@SNK2017"));
			$password = $pass. md5('sonnk');  
			$array['password'] = $password;
		}
		else{
			unset($array['password']);
		}
		unset($array['cfpassword']);
		//unset($array['username']);
		$this->model->table('hre_users')->where('id',$id)->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		 $this->model->table('hre_users')->where("id in ($id)")->update($array);
		 return 1;
	}
}