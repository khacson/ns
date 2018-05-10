<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class HolidaysyearModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_holidays_year')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$login = $this->login;
		$sql = "";
		if(!empty($search['holidays_year_from'])){
			$sql.= " and h.holidays_year_from like '%".$search['holidays_year_from']."%' ";	
		}
		if(!empty($search['holidays_year_to'])){
			$sql.= " and h.holidays_year_to like '%".$search['holidays_year_to']."%' ";	
		}
		if(!empty($search['holidays_date'])){
			$sql.= " and h.holidays_date like '%".$search['holidays_date']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT h.*
				FROM `hre_holidays_year` AS h
				WHERE h.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY h.holidays_year_from DESC  ";
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
			FROM `hre_holidays_year` AS h
			WHERE h.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$login = $this->login;
		$checkDate =  $this->model->table('hre_holidays_year')
						   ->where('holidays_year_from',$array['holidays_year_from'])
						   ->where('holidays_year_to',$array['holidays_year_to'])
						   ->where('isdelete',0)->find();
		if(!empty($checkDate->id)){
			return -1;
		}
		$result = $this->model->table('hre_holidays_year')->insert($array);	
		return $result;
	}
	function edits($array,$id){
		$login = $this->login;
		
		$checkDate =  $this->model->table('hre_holidays_year')
								  ->where('holidays_year_from',$array['holidays_year_from'])
								  ->where('holidays_year_to',$array['holidays_year_to'])
								  ->where('id <> ',$id)
								  ->where('isdelete',0)->find();
		if(!empty($checkDate->id)){
			return -1;
		}
		$this->model->table('hre_holidays_year')
					->where('id',$id)
					->update($array);	
		return $id;
	}
	function deletes($id,$array){
		$this->model->table('hre_holidays_year')
					->where("id in ($id)")
					->delete();
		return 1;
	}
}