<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmpabsentModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id){
        $query = $this->model->table('hre_timesheets')
					  ->where('isdelete',0)
					  ->where("id in ($id)")
					  ->find();
        return $query;
    }
	function getEmployee(){

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
		if(!empty($login['branchid'])){
			$sql.= " and e.branchid in (".$login['branchid'].")";	
		}
		else{
			if(!empty($search['branchid'])){
				$sql.= " and e.branchid in (".$search['branchid'].") ";	
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
		/*$sql.= " and ts.time_start >= '".fmDateSave($search['datenow'])." 00:00:00' 
				 and ts.time_end <= '".fmDateSave($search['datenow'])." 23:59:59' ";*/
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$from = fmDateSave($search['datenow']).' 00:00:00';
		$to = fmDateSave($search['datenow']).' 23:59:59';
		$sql = "SELECT e.id, e.code,e.identity , e.fullname, d.departmanet_name, e.departmentid, p.position_name, dg.departmentgroup_name, e.group_work_id, e.positionid
				from hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid and p.isdelete = 0
				left join hre_departmentgroup dg on dg.id = e.group_work_id
				WHERE e.isdelete = 0 
				and e.id not in(
					select ts.employeeid
					from hre_timesheets ts
					where ts.isdelete = 0
					and ts.time_start >= '$from'
					and ts.time_end <= '$to'
				)
				$searchs
				and d.isdelete = 0
				
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY e.code DESC ';
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
		$from = fmDateSave($search['datenow']).' 00:00:00';
		$to = fmDateSave($search['datenow']).' 23:59:59';
		$sql = "SELECT count(1) total
				from hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid  and p.isdelete = 0
				WHERE e.isdelete = 0 
				and e.id not in(
					select ts.employeeid
					from hre_timesheets ts
					where ts.isdelete = 0
					and ts.time_start >= '$from'
					and ts.time_end <= '$to'
				)
				$searchs
				and d.isdelete = 0
				";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
}