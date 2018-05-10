<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class BonusholidayModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function getSearch($search){
		$sql = "";
		if(!empty($search['code'])){
			$sql.= " and e.code like '%".$search['code']."%' ";	
		}
		if(!empty($search['fullname'])){
			$sql.= " and e.fullname like '%".$search['fullname']."%' ";	
		}
		if(!empty($search['identity'])){
			$sql.= " and e.identity like '%".$search['identity']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and e.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['departmentid'])){
			$sql.= " and e.departmentid in (".$search['departmentid'].") ";	
		}
		if(!empty($search['positionid'])){
			$sql.= " and e.positionid in (".$search['positionid'].") ";	
		}
		if(!empty($this->login['departmentid'])){
			$sql.= " and e.departmentid = '".$this->login['departmentid']."' ";	
		}
		else{
			if(!empty($search['departmentid'])){
				$sql.= " and e.departmentid in (".$search['departmentid'].") ";	
			}
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = "
				SELECT e.*, d.departmanet_name, p.position_name, dg.departmentgroup_name
				FROM hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid
				left join hre_departmentgroup dg on dg.id = e.group_work_id
				where e.isdelete = 0
				and e.jobstatusid <> 4
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY e.fullname ASC ';
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
				FROM hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid
				where e.isdelete = 0
				and e.jobstatusid <> 4
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
	function getHolidayYear(){
		$query = $this->model->table('hre_holidays_year')
					  ->select('id,holidays_year_from,holidays_year_to,holidays_date')
					  ->where('isdelete',0)
					  ->find_all();
		return $query;
	}
}