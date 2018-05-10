<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class ProfileModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id){
		$query = $this->model->table('hre_users')
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		if(!empty($query->id)){
			return $query;
		}
		else{
			return $this->getNone('hre_users');
		}
	}
	function getNone($table){
		$sql = "
		SELECT column_name, column_default
		FROM information_schema.columns
		WHERE table_name='$table'; 
		";
		$query = $this->model->query($sql)->execute();
		$obj = new stdClass();
		foreach($query as $item){
			$clm = $item->column_name;
			$obj->$clm = $item->column_default;
		}
		return $obj;
	} 
}