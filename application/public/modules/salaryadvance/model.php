<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class SalaryadvanceModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_salaryadvance')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
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
			$sql.= " and r.branchid in (".$login['branchid'].")";	
		}
		else{
			if(!empty($search['branchid'])){
				$sql.= " and r.branchid in (".$search['branchid'].") ";	
			}
		}
		if(!empty($login['departmentid'])){
			$sql.= " and r.departmentid in (".$login['departmentid'].")";	
		}
		else{
			if(!empty($search['departmentid'])){
				$sql.= " and r.departmentid in (".$search['departmentid'].") ";	
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
		if(!empty($search['fromdate'])){
			$sql.= " and r.salaryadvance_date >= '".fmDateSave($search['fromdate'])." 00:00:00' ";	
		}
		if(!empty($search['todate'])){
			$sql.= " and r.salaryadvance_date <= '".fmDateSave($search['todate'])." 00:00:00' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT r.*, e.fullname, e.code, d.departmanet_name
				FROM `hre_salaryadvance` AS r
				LEFT JOIN `hre_employee` e on e.id = r.employeeid
				left join `hre_department` d on d.id = r.departmentid
				WHERE r.isdelete = 0 
				$searchs
				and e.isdelete = 0
				and d.isdelete = 0
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY r.salaryadvance_date desc  ";
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
			FROM `hre_salaryadvance` AS r
			LEFT JOIN `hre_employee` e on e.id = r.employeeid
			left join `hre_department` d on d.id = r.departmentid
			WHERE r.isdelete = 0
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
	function saves($array,$id){
		$login = $this->login;
		 if(empty($array['salaryadvance_date'])){
			 $array['salaryadvance_date'] = gmdate("Y-m-d", time() + 7 * 3600);
		 }
		 else{
			  $array['salaryadvance_date'] =  fmDateSave($array['salaryadvance_date']);
		 }
		 $array['departmentid'] =  $this->findDepartment($array['employeeid']);
		 $array['branchid'] = $login['branchid'];
		 $array['salaryadvance_money'] =  fmNumberSave($array['salaryadvance_money']);
		 $result = $this->model->table('hre_salaryadvance')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$login = $this->login;
		if(empty($array['salaryadvance_date'])){
			$array['salaryadvance_date'] = gmdate("Y-m-d", time() + 7 * 3600);
		}
		else{
			$array['salaryadvance_date'] =  fmDateSave($array['salaryadvance_date']);
		}
		$array['departmentid'] =  $this->findDepartment($array['employeeid']);
		$array['branchid'] = $login['branchid'];
		$array['salaryadvance_money'] =  fmNumberSave($array['salaryadvance_money']);
		$this->model->table('hre_salaryadvance')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_salaryadvance')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}