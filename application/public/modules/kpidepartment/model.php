<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class KpidepartmentModel extends CI_Model
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
	function getKPI($monthid,$departmentid=''){
		 $query = $this->model->table('hre_departmentkpi')
					  ->where('isdelete',0);
		 $query->where('monthid',$monthid);			  
		 if(!empty($departmentid)){
			$query =  $query->where('departmentid',$departmentid);
		 }		 
		 $query =  $query->find_all();
		 $array = array();
		 foreach($query as $item){
			 $array[$item->departmentid][$item->kpiid] = $item->point;
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
			$sql.= " and d.id in (".$search['departmentid'].") ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT d.*, d.id as departmentid
				FROM hre_department d
				WHERE d.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY d.departmanet_name  ASC  ";
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
			FROM `hre_department` AS d
			WHERE d.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function getDays($month,$year){
		if($month == 4 || $month == 6 || $month == 9 || $month == 11){
			$days = 30;
		}
		else if($month == 2){
			if($year % 400 == 0 || ($year % 4 == 0 && $year % 100 !=0)){
				$days = 29;
			}
			else{
				$days = 28;
			}
		}
		else{
			$days = 31;
		}
		return $days;
	}
	function saves($array){
		$login = $this->login;
		$arrInput = array();
		$arrInputMax = array();
		foreach($array as $key=>$val){
			$sub = substr($key,0,4);
			$sub2 = substr($key,0,8);
			if($sub == 'kpi_'){
				$kpiid = str_replace('kpi_','',$key);
				$arrInput[$kpiid] = $val;
			}
			if($sub2 == 'max_kpi_'){
				$kpiid = str_replace('max_kpi_','',$key);
				$arrInputMax[$kpiid] = $val;
			}
		} 
		$i = 0; 
		foreach($arrInput as $kpiid => $point){
			//Check
			$check = $this->model->table('hre_departmentkpi')->select('id')
						  ->where('departmentid',$array['departmentid'])
						  ->where('kpiid',$kpiid)
						  ->where('monthid',$array['monthid'])
						  ->find();
			$arrAdd = array();
			$arrAdd['departmentid'] = $array['departmentid'];
			$arrAdd['branchid'] = $login['branchid'];
			$arrAdd['kpiid'] = $kpiid;
			$arrAdd['monthid'] = $array['monthid'];
			$max = 0;
			if(!empty($arrInputMax[$kpiid])){
				$max = $arrInputMax[$kpiid];
			}
			$arrAdd['point'] = $point;
			if($point > $max){
				$arrAdd['point'] = $max;
			}
			if(empty($check->id)){
				$arrAdd['datecreate'] = $array['datecreate'];
				$arrAdd['usercreate'] = $array['usercreate'];
				$this->model->table('hre_departmentkpi')->insert($arrAdd);
			}
			else{
				$arrAdd['dateupdate'] = $array['datecreate'];
				$arrAdd['userupdate'] = $array['usercreate'];
				$this->model->table('hre_departmentkpi')->save($check->id,$arrAdd);
			}
			$i++;
		}
		return $i;
	}
}