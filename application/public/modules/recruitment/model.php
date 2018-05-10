<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class RecruitmentModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_recruitmentrequest')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['departmentid'])){
			$sql.= " and r.departmentid in (".$search['departmentid'].") ";	
		}
		if(!empty($search['request'])){
			$sql.= " and r.request in (".$search['request'].") ";	
		}
		if(!empty($search['approved'])){
			$sql.= " and r.approved in (".$search['approved'].") ";	
		}
		if(!empty($search['quantity'])){
			$sql.= " and r.quantity like '%".$search['quantity']."%' ";	
		}
		if(!empty($search['note'])){
			$sql.= " and r.note like '%".$search['note']."%' ";	
		}
		
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT r.*, d.departmanet_name, al.academic_name
				FROM `hre_recruitmentrequest` AS r
				LEFT JOIN `hre_department` AS d on d.id = r.departmentid
				LEFT JOIN `hre_academic_level` AS al on al.id = r.academic_levelid
				WHERE r.isdelete = 0 
				$searchs
				
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY r.datecreate DESC  ";
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
			FROM `hre_recruitmentrequest` AS r
			WHERE r.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		 $result = $this->model->table('hre_recruitmentrequest')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$this->model->table('hre_recruitmentrequest')
					->where('id',$id)
					->update($array);	
		return $id;
	}
	function deletes($id,$array){
		$this->model->table('hre_recruitmentrequest')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}