<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class InsuranceModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_insurance')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getTypes() {
        $query = array();
		$query[1] = '%';
		$query[2] = 'Tiền';
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['insurance_name'])){
			$sql.= " and i.insurance_name like '%".$search['insurance_name']."%' ";	
		}
		if(!empty($search['insurance_key'])){
			$sql.= " and i.insurance_key like '%".$search['insurance_key']."%' ";	
		}
		if(!empty($search['insurance_value'])){
			$sql.= " and i.insurance_value like '%".$search['insurance_value']."%' ";	
		}
		if(!empty($search['insurance_type'])){
			$sql.= " and i.insurance_type in (".$search['insurance_type'].") ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT i.*
				FROM `hre_insurance` AS i
				WHERE i.isdelete = 0 
				$searchs
				ORDER BY i.insurance_name ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_insurance` AS i
			WHERE i.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_insurance')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('insurance_name',$array['insurance_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $array['insurance_value'] = fmNumberSave($array['insurance_value']);
		 $result = $this->model->table('hre_insurance')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_insurance')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('insurance_name',$array['insurance_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$array['insurance_value'] = fmNumberSave($array['insurance_value']);
		$this->model->table('hre_insurance')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_insurance')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}