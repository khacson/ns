<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class UpdateshiftModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id){
        $query = $this->model->table('hre_employee')
					  ->where('isdelete',0)
					  ->where("id",$id)
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
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = "SELECT e.id, e.code,e.identity , e.fullname, d.departmanet_name, e.departmentid, p.position_name, dg.departmentgroup_name, e.group_work_id, e.positionid, s.shift_name
				from hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_shift s on s.id = e.shiftid
				left join hre_position p on p.id = e.positionid and p.isdelete = 0
				left join hre_departmentgroup dg on dg.id = e.group_work_id
				WHERE e.isdelete = 0 
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
		$sql = "SELECT count(1) total
				from hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid  and p.isdelete = 0
				WHERE e.isdelete = 0 
				$searchs
				and d.isdelete = 0
				";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function edits($search,$id){
		if(!empty($search['code'])){
			$arrCode = explode(',',$search['code']);
			$array = array();
			foreach($arrCode as $key=>$code){
				$array['shiftid'] = $search['shiftid'];
				$result = $this->model->table('hre_employee')->where('code',$code)->update($array);	
			}
		}
		return $id;
	 }
}