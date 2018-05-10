<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class LanguageModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_language')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['langkey'])){
			$sql.= " and u.langkey like '%".$search['langkey']."%' ";	
		}
		if(!empty($search['langname'])){
			$sql.= " and u.langname like '%".$search['langname']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = " SELECT u.*
				FROM hre_language AS u
				WHERE u.isdelete = 0 
				$searchs
				ORDER BY u.langname ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM hre_language AS u
			WHERE u.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$check = $this->model->table('hre_language')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('langkey',$array['langkey'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_language')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$check = $this->model->table('hre_language')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('langkey',$array['langkey'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_language')->where('id',$id)->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		 $this->model->table('hre_language')->where("id in ($id)")->update($array);
		 return 1;
	}
}