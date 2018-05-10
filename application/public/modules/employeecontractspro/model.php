<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmployeecontractsproModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
		function getSearch($search){
		$sql = "";
		if(!empty($search['code'])){
			$sql.= " and s.code like '%".$search['code']."%' ";	
		}
		if(!empty($search['fullname'])){
			$sql.= " and s.fullname like '%".$search['fullname']."%' ";	
		}
		if(!empty($search['identity'])){
			$sql.= " and s.identity like '%".$search['identity']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and s.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['departmentid'])){
			$sql.= " and s.departmentid in (".$search['departmentid'].") ";	
		}
		if(!empty($search['positionid'])){
			$sql.= " and s.positionid in (".$search['positionid'].") ";	
		}
		if(!empty($search['jobstatusid'])){
			$sql.= " and s.jobstatusid in (".$search['jobstatusid'].") ";	
		}
		if(!empty($search['academic_level'])){
			$sql.= " and s.academic_level in (".$search['academic_level'].") ";	
		}
		if(!empty($search['ethnicid'])){
			$sql.= " and s.ethnicid in (".$search['ethnicid'].") ";	
		}
		if(!empty($search['religionid'])){
			$sql.= " and s.religionid in (".$search['religionid'].") ";	
		}
		if(!empty($this->login['departmentid'])){
			$sql.= " and s.departmentid = '".$this->login['departmentid']."' ";	
		}
		else{
			if(!empty($search['departmentid'])){
				$sql.= " and s.departmentid in (".$search['departmentid'].") ";	
			}
		}
		$sql.= " and s.jobstatusid = 3"; 
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = "
				SELECT s.*, d.departmanet_name, p.position_name, dg.departmentgroup_name
				FROM hre_employee s
				left join hre_department d on d.id = s.departmentid
				left join hre_position p on p.id = s.positionid
				left join hre_departmentgroup dg on dg.id = s.group_work_id
				where s.isdelete = 0
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY s.fullname ASC ';
		}
		else{
			$sql.= ' ORDER BY '.$search['order'].' '.$search['index'].' ';
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
				FROM hre_employee s
				left join hre_department d on d.id = s.departmentid
				left join hre_position p on p.id = s.positionid
				where s.isdelete = 0
				$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function findID($id){
		 $query = $this->model->table('hre_employee')
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
}