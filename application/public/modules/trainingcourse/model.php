<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class TrainingcourseModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_trainingcourse')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['trainingcourse_name'])){
			$sql.= " and tn.trainingcourse_name like '%".$search['trainingcourse_name']."%' ";	
		}
		if(!empty($search['description'])){
			$sql.= " and tn.description like '%".$search['description']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT tn.*
				FROM `hre_trainingcourse` AS tn
				WHERE tn.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY tn.datecreate ASC  ";
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
			FROM `hre_trainingcourse` AS tn
			WHERE tn.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		 $array['time_start'] =  fmDateSave($array['time_start']); 
		 $array['time_end'] =  fmDateSave($array['time_end']); 
		 $result = $this->model->table('hre_trainingcourse')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$array['time_start'] =  fmDateSave($array['time_start']); 
		 $array['time_end'] =  fmDateSave($array['time_end']); 
		$this->model->table('hre_trainingcourse')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		$this->model->table('hre_trainingcourse')
					->where("id in ($id)")
					->delete();
		return 1;
	}
}