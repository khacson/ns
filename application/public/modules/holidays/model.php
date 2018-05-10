<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class HolidaysModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_holidays')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$login = $this->login;
		$sql = "";
		if(!empty($login['branchid'])){
			$sql.= " and h.branchid in (".$login['branchid'].")";	
		}
		if(!empty($search['dateoff'])){
			$sql.= " and h.dateoff = '".$search['dateoff']."' ";	
		}
		if(!empty($search['datework'])){
			$sql.= " and h.datework = '".$search['datework']."' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT h.*
				FROM `hre_holidays` AS h
				WHERE h.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY h.dateoff DESC  ";
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
			FROM `hre_holidays` AS h
			WHERE h.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$login = $this->login;
		unset($array['s2id_typeid']);
		if(!empty($login['branchid'])){
			$array['branchid'] = $login['branchid'];
		}
		if(!empty($array['dateoff'])){
			$array['dateoff'] = fmDateSave($array['dateoff']);
		}
		else{
			$array['dateoff'] = '';
		}
		if(!empty($array['datework'])){
			$array['datework'] = fmDateSave($array['datework']);
		}
		else{
			$array['datework'] = '';
		}
		$checkDate =  $this->model->table('hre_holidays')->where('dateoff',$array['dateoff'])->where('isdelete',0)->find();
		if(!empty($checkDate->id)){
			return -1;
		}
		$result = $this->model->table('hre_holidays')->insert($array);	
		return $result;
	}
	function edits($array,$id){
		$login = $this->login;
		unset($array['s2id_typeid']);
		$login = $this->login;
		if(!empty($login['branchid'])){
			$array['branchid'] = $login['branchid'];
		}
		if(!empty($array['dateoff'])){
			$array['dateoff'] = fmDateSave($array['dateoff']);
		}
		else{
			$array['dateoff'] = '';
		}
		if(!empty($array['datework'])){
			$array['datework'] = fmDateSave($array['datework']);
		}
		else{
			$array['datework'] = '';
		}
		$checkDate =  $this->model->table('hre_holidays')
								  ->where('dateoff',$array['dateoff'])
								  ->where('id <> ',$id)
								  ->where('isdelete',0)->find();
		if(!empty($checkDate->id)){
			return -1;
		}
		$this->model->table('hre_holidays')
					->where('id',$id)
					->update($array);	
		return $id;
	}
	function deletes($id,$array){
		$this->model->table('hre_holidays')
					->where("id in ($id)")
					->delete();
		return 1;
	}
}