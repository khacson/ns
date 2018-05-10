<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class SalarygeneralModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_salary')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getInsurance(){
		 $query = $this->model->table('hre_insurance')
					  ->select('id,insurance_name,insurance_key,insurance_value,insurance_type')
					  ->where('isdelete',0)
					  ->order_by('insurance_name','asc')
					  ->find_all();
        return $query;
	}
	function getAllowance(){
		 $query = $this->model->table('hre_allowance')
					  ->select('id,allowance_name')
					  ->where('isdelete',0)
					  ->find_all();
        return $query;
	}
	function getAllowanceSalary($endoffmonthid){
		 $query = $this->model->table('hre_salary_allowance')
					  ->select('id,allowanceid,salary,employeeid,typeid')
					  ->where('isdelete',0)
					  ->where('endoffmonthid',$endoffmonthid)
					  ->find_all();
        return $query;
	}
	function getEndoffmonth(){
		 $query = $this->model->table('hre_endoffmonth')
					  ->select('id,monthyear')
					  ->where('isdelete',0)
					  ->order_by('monthyear','desc')
					  ->find_all();
        return $query;
	}
	function getEmployee($departmentid) {
        $query = $this->model->table('hre_employee')
					  ->select('id,code,fullname')
					  ->where('isdelete',0);
		if(!empty($departmentid)){
			$query = $query->where('departmentid',$departmentid);
		}
		$query = $query->find_all();
        return $query;
    }
	function getSearch($search){
		//departmentid
		$sql = "";
		if(!empty($login['branchid'])){
			$sql.= " and s.branchid in (".$login['branchid'].")";	
		}
		else{
			if(!empty($search['branchid'])){
				$sql.= " and s.branchid in (".$search['branchid'].") ";	
			}
		}
		if(!empty($login['departmentid'])){
			$sql.= " and e.departmentid in (".$login['departmentid'].")";	
		}
		else{
			if(!empty($search['departmentid'])){
				$sql.= " and e.departmentid in (".$search['departmentid'].") ";	
			}
		}
		if(!empty($search['fullname'])){
			$sql.= " and e.fullname like '%".$search['fullname']."%' ";	
		}
		if(!empty($search['identity'])){
			$sql.= " and e.identity like '%".$search['identity']."%' ";	
		}
		if(!empty($search['code'])){
			$sql.= " and e.code like '%".$search['code']."%' ";	
		}
		if(!empty($search['endoffmonthid'])){
			$sql.= " and s.endoffmonthid in (".$search['endoffmonthid'].") ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT s.*, e.departmentid, e.fullname, e.code, d.departmanet_name
				FROM `hre_salary` AS s
				LEFT JOIN `hre_employee` e on e.id = s.employeeid
				left join `hre_department` d on d.id = e.departmentid
				WHERE s.isdelete = 0 
				$searchs
				and e.isdelete = 0
				and d.isdelete = 0
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY e.fullname asc  ";
		}
		else{
			$sql.= " ORDER BY ".$search['order']." ".$search['index']." ";
		}
		if(!empty($rows)){
			$sql.= ' limit '.$page.','.$rows;
		}
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_salary` AS s
			LEFT JOIN `hre_employee` e on e.id = s.employeeid
			left join `hre_department` d on d.id = e.departmentid
			WHERE s.isdelete = 0
			$searchs	
			AND e.isdelete = 0
			and d.isdelete = 0
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function findDepartment($employeeid){
		$find = $this->model->table('hre_employee')
							->select('id,departmentid')
							->where('id',$employeeid)
							->find();
		$departmentid = 0;
		if(!empty($find->departmentid)){
			$departmentid = $find->departmentid;
		}
		return $departmentid;
	}
	function saves($array,$allowance,$id){
		$this->db->trans_start();
		$login = $this->login;
		$allowance = json_decode($allowance,true);
		$arrayDetail = array();
		foreach($allowance as $key=>$val){
			$arr = explode('_',$key);
			if(isset($arr[1]) && $arr[0] == 'typeid'){
				$arrayDetail[$arr[1]] = $val;
			}
		}
		$find = $this->model->table('hre_salary')
							->select('id')
							->where('endoffmonthid',$array['endoffmonthid'])
							->where('employeeid',$array['employeeid'])
							->find();
		if(!empty($find->id)){
			return -1;
		}
		$arrayInsert = array();
		$arrayInsert['endoffmonthid'] = $array['endoffmonthid'];
		$arrayInsert['employeeid'] = $array['employeeid'];
		$arrayInsert['salary_status'] = $array['salary_status'];
		$arrayInsert['branchid'] = $login['branchid'];
		$arrayInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$arrayInsert['userupdate'] =  $login['userlogin'];
		$arrayInsert['salary'] =  fmNumberSave($array['salary']);
		$result = $this->model->table('hre_salary')->insert($arrayInsert);
		//Insert detail
		foreach($arrayDetail as $detail => $typeid){
			if(isset($allowance[$detail])){
				$arrInsert = array();
				$arrInsert['endoffmonthid'] = $array['endoffmonthid'];
				$arrInsert['employeeid'] = $array['employeeid'];
				$arrInsert['branchid'] = $login['branchid'];
				$arrInsert['salary'] = fmNumberSave($allowance[$detail]);
				$arrInsert['typeid'] = $typeid;
				$arrInsert['allowanceid'] = $detail;
				$arrInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
				$arrInsert['usercreate'] = $login['userlogin'];
				$this->model->table('hre_salary_allowance')->insert($arrInsert);
			}
		}
		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} 
		else {
			$this->db->trans_commit();
			return 1;
		}
	}
	function edits($array,$allowance,$id){
		$this->db->trans_start();
		$login = $this->login;
		$allowance = json_decode($allowance,true);
		$arrayDetail = array();
		foreach($allowance as $key=>$val){
			$arr = explode('_',$key);
			if(isset($arr[1]) && $arr[0] == 'typeid'){
				$arrayDetail[$arr[1]] = $val;
			}
		}
		$find = $this->model->table('hre_salary')
							->select('id')
							->where('endoffmonthid',$array['endoffmonthid'])
							->where('employeeid',$array['employeeid'])
							->where('id <>',$id)
							->find();
		if(!empty($find->id)){
			return -1;
		}
		$arrayInsert = array();
		$arrayInsert['endoffmonthid'] = $array['endoffmonthid'];
		$arrayInsert['employeeid'] = $array['employeeid'];
		$arrayInsert['salary_status'] = $array['salary_status'];
		$arrayInsert['branchid'] = $login['branchid'];
		$arrayInsert['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$arrayInsert['userupdate'] =  $login['userlogin'];
		$arrayInsert['salary'] =  fmNumberSave($array['salary']);
		$result = $this->model->table('hre_salary')->save($id,$arrayInsert);
		//Insert detail
		$this->model->table('hre_salary_allowance')
					->where('employeeid',$array['employeeid'])
					->where('endoffmonthid',$array['endoffmonthid'])
					->delete();
		foreach($arrayDetail as $detail => $typeid){
			if(isset($allowance[$detail])){
				$arrInsert = array();
				$arrInsert['endoffmonthid'] = $array['endoffmonthid'];
				$arrInsert['employeeid'] = $array['employeeid'];
				$arrInsert['branchid'] = $login['branchid'];
				$arrInsert['salary'] = fmNumberSave($allowance[$detail]);
				$arrInsert['typeid'] = $typeid;
				$arrInsert['allowanceid'] = $detail;
				$arrInsert['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
				$arrInsert['userupdate'] = $login['userlogin'];
				$this->model->table('hre_salary_allowance')->insert($arrInsert);
			}
		}
		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} 
		else {
			$this->db->trans_commit();
			return 1;
		}
	}
	function deletes($id,$finds){
		$this->model->table('hre_salary')
					->where("id in ($id)")
					->delete();
		$check = $this->model->table('hre_salary_allowance')
							 ->select('id')
							 ->where('employeeid',$finds->employeeid)
							 ->where('endoffmonthid',$finds->endoffmonthid)
							 ->find_all();
		foreach($check as $item){
			$this->model->table('hre_salary_allowance')
					->where("id",$item->id)
					->delete();
		}
	}
}