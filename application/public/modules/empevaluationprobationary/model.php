<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmpevaluationprobationaryModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function getMonth(){
		 $query = $this->model->table('hre_endoffmonth')
					  ->select('id,monthyear,date_start,date_end')
					  ->where('isdelete',0)
					  ->find_all();
        return $query;
	}
	function getCriteriaProbationary($employeeid=''){
		 $query = $this->model->table('hre_empevaluationprobationary')
					  ->where('isdelete',0);		  
		 if(!empty($employeeid)){
			$query =  $query->where('employeeid',$employeeid);
		 }		 
		 $query =  $query->find_all();
		 $array = array();
		 foreach($query as $item){
			 $array[$item->employeeid][$item->catalogid] = $item;
		 }
         return $array;
	}
	function findID($id) {
		
        $query = $this->model->table('hre_employee')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['departmentid'])){
			$sql.= " and e.departmentid in (".$search['departmentid'].") ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and e.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['identity'])){
			$sql.= " and e.identity like '%".$search['identity']."%' ";	
		}
		if(!empty($search['code'])){
			$sql.= " and e.code like '%".$search['code']."%' ";	
		}
		if(!empty($search['fullname'])){
			$sql.= " and e.fullname like '%".$search['fullname']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT e.*, d.departmanet_name
				FROM `hre_employee` AS e
				LEFT JOIN hre_department d on d.id = e.departmentid
				WHERE e.isdelete = 0 
				$searchs
				and e.jobstatusid = 3
				and d.isdelete = 0
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY e.fullname , e.departmentid ASC  ";
		}
		else{
			$sql.= " ORDER BY ".$search['order']." ".$search['index']." ";
		} 
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_employee` AS e
			LEFT JOIN hre_department d on d.id = e.departmentid
			WHERE e.isdelete = 0
			and e.jobstatusid = 3
			$searchs	
			and d.isdelete = 0
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array){
		$login = $this->login;
		$arrInput = array();
		foreach($array as $key=>$val){
			$sub = substr($key,0,4);
			$sub2 = substr($key,0,8);
			if($sub == 'kpi_'){
				$catalogid = str_replace('kpi_','',$key);
				$arrInput[$catalogid] = $val;
			}
		} 
		$i = 0; 
		//print_r($arrInput); 
		//print_r($array);
		//exit;
		foreach($arrInput as $catalogid => $point){
			//Check
			$check = $this->model->table('hre_empevaluationprobationary')
						  ->where('employeeid',$array['employeeid'])
						  ->where('catalogid',$catalogid)
						  ->delete();
			$arrAdd = array();
			$arrAdd['employeeid'] = $array['employeeid'];
			$arrAdd['description'] = $array['description'];
			$arrAdd['statusid'] = $array['statusid'];
			$arrAdd['departmentid'] = $array['departmentid'];
			$arrAdd['branchid'] = $login['branchid'];
			$arrAdd['catalogid'] = $catalogid;
			$arrAdd['point'] = $point;
			$arrAdd['datecreate'] = $array['datecreate'];
			$arrAdd['usercreate'] = $array['usercreate'];
			$this->model->table('hre_empevaluationprobationary')->insert($arrAdd);
			$i++;
		}
		return $i;
	}
}