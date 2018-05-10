<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class CriteriakpidepartmentModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_criteriakpi_department')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['kpi_code'])){
			$sql.= " and k.kpi_code like '%".$search['kpi_code']."%' ";	
		}
		if(!empty($search['kpi_name'])){
			$sql.= " and k.kpi_name like '%".$search['kpi_name']."%' ";	
		}
		if(!empty($search['kpi_point_max'])){
			$sql.= " and k.kpi_point_max like '%".$search['kpi_point_max']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT k.*
				FROM `hre_criteriakpi_department` AS k
				WHERE k.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY k.kpi_name ASC  ";
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
			FROM `hre_criteriakpi_department` AS k
			WHERE k.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_criteriakpi_department')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('kpi_name',$array['kpi_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_criteriakpi_department')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_criteriakpi_department')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('kpi_name',$array['kpi_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_criteriakpi_department')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_criteriakpi_department')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}