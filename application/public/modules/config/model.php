<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class ConfigModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findConfig($companyid) {
        $query = $this->model->table('hre_config')
					  ->where('isdelete',0)
					  ->where('companyid',$companyid)
					  ->find();
        return $query;
    }
	function findID($id) {
        $query = $this->model->table('hre_config')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	
	function edits($array,$id){
		$this->model->table('hre_config')->where('id',$id)->update($array);	
		return $id;
		
	}
}