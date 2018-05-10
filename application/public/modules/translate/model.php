<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class TranslateModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_translate')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function findKeyMenu($key) {
        $query = $this->model->table('hre_menus')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('keylang',$key)
					  ->find();
        if(!empty($query->id)){
			return 1;
		}
		else{
			return 0;
		}
    }
	function getLanguage(){
		
		$query = $this->model->table('hre_language')
				      ->select('langkey,id,langname')
					  ->where('isdelete',0)
					  ->find_all();
		return $query;
	}
	function getSearch($search){
		$sql = "";
		$langkey = str_replace('"','',$search['langkey']);
		if(!empty($langkey)){
			$sql.= " and p.langkey = '".$langkey."' ";	
		}
		if(!empty($search['keyword'])){
			$sql.= " and p.keyword like '%".$search['keyword']."%' ";	
		}
		if(!empty($search['translation'])){
			$sql.= " and p.translation like '%".$search['translation']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT p.*
				FROM `hre_translate` AS p
				WHERE p.isdelete = 0 
				$searchs
				ORDER BY p.langkey ASC, p.keyword 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_translate` AS p
			WHERE p.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		unset($array['undefined']);
		$check = $this->model->table('hre_translate')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('keyword',$array['keyword'])
					  ->where('langkey',$array['langkey'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $array['keyword'] = trim($array['keyword']);
		 $search['ismenu'] = $this->findKeyMenu($array['keyword']);
		 $search['langkey'] = str_replace('"','',$array['langkey']);
		 $result = $this->model->table('hre_translate')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		unset($array['undefined']);
		$check = $this->model->table('hre_translate')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('keyword',$array['keyword'])
				  ->where('langkey',$array['langkey'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$array['keyword'] = trim($array['keyword']);
		$array['ismenu'] = $this->findKeyMenu($array['keyword']);
		$array['langkey'] = str_replace('"','',$array['langkey']);
		$this->model->table('hre_translate')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_translate')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}