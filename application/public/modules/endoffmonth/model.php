<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EndoffmonthModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_endoffmonth')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['monthyear'])){
			$sql.= " and u.monthyear like '%".$search['monthyear']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT u.*
				FROM `hre_endoffmonth` AS u
				WHERE u.isdelete = 0 
				$searchs
				ORDER BY u.monthyear ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_endoffmonth` AS u
			WHERE u.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$check = $this->model->table('hre_endoffmonth')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('monthyear',$array['monthyear'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $array['date_end'] = fmDateSave($array['date_end']);
		 $array['date_start'] = fmDateSave($array['date_start']);
		 $result = $this->model->table('hre_endoffmonth')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_endoffmonth')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('monthyear',$array['monthyear'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$array['date_end'] = fmDateSave($array['date_end']);
		$array['date_start'] = fmDateSave($array['date_start']);
		$this->model->table('hre_endoffmonth')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_endoffmonth')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}