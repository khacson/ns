<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmpcomelateModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_employee')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getEmployee(){

	}
	function getSearch($search){
		$sql = "";
		if(!empty($search['absent_content'])){
			$sql.= " and c.absent_content like '%".$search['absent_content']."%' ";	
		}
		if(!empty($search['departmentid'])){
			$sql.= " and s.departmentid in (".$search['departmentid'].") ";	
		}
		if(!empty($search['staffid'])){
			$sql.= " and c.staffid in (".$search['staffid'].") ";	
		}
		if(!empty($search['absent_date'])){
			$sql.= " and c.absent_date = '".date('Y-m-d',strtotime($search['absent_date']))."' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = "SELECT c.id, c.absent_content, c.absent_date, c.staffid, c.schoolid, s.code, s.fullname, d.departmanet_name, s.departmentid, c.absent_times
				FROM hre_absent AS c
				left join hre_employee s on s.id = staffid
				left join hre_department d on d.id = s.departmentid
				WHERE c.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.id DESC ';
		}
		else{
			$sql.= ' ORDER BY '.$search['order'].' '.$search['index'].' ';
		}
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total
		FROM hre_absent AS c
				left join hre_employee s on s.id = staffid
				left join hre_department d on d.id = s.departmentid
				WHERE c.isdelete = 0 
		$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($search){
		
		$array = array();
		$array['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['usercreate'] = $search['usercreate'];
		$array['staffid'] = $search['staffid'];
		$array['absent_content'] = $search['absent_content'];
		$array['absent_times'] = $search['absent_times'];
		$array['absent_date'] = date('Y-m-d',strtotime($search['absent_date']));
		
		$result = $this->model->table('hre_absent')->insert($array);	
		return 1;
	}
	function edits($search,$id){
		 $array = array();
		 $array['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		 $array['userupdate'] = $search['userupdate'];
		 $array['staffid'] = $search['staffid'];
		 $array['absent_content'] = $search['absent_content'];
		 $array['absent_times'] = $search['absent_times'];
		 $array['absent_date'] = date('Y-m-d',strtotime($search['absent_date']));
		 
		 $result = $this->model->table('hre_absent')->where('id',$id)->update($array);	
		 return $id;
	 }
}