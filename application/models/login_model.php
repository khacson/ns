<?php

/**
 * @author 
 * @copyright 2015
 */
class login_model extends CI_Model {
	var $tbgroup;
	var $tbmenus;
    function __construct() {
        parent::__construct('');
        $this->load->model();
		$this->tbgroup = 'g_groups'; 
		$this->tbmenus ='g_menus'; 
    }
    function permisisons($contronller,$groupid) {
        $gc_menus = $this->model->table($this->tbmenus)
                ->select('id')
                ->where("(`route` = '$contronller' or `route2` = '$contronller')")
                ->where('isdelete', 0)
                ->find();
		$group = $this->model->table($this->tbgroup)
								 ->select('groupid,params')
								 ->where('groupid',$groupid)
								 ->where('isdelete',0)
								 ->find();
		
		if(!empty($gc_menus->id)){
			$id = $gc_menus->id;
			$permission = json_decode($group->params,true);
			if(isset($permission[$id])){
				return $permission[$id];
			} 
			else{
				return "";
			}
		}
		else{
			return "";
		}
    }
	function permisisonWorkflow($groupid){
		$gc_menus = $this->model->table($this->tbmenus)
                ->select('id,route')
                ->where("(`route` = 'receiving' or `route` like 'process/%')")
                ->where('isdelete', 0)
                ->find_all();
		$group = $this->model->table('gce_groups')
								 ->select('groupid,params')
								 ->where('groupid',$groupid)
								 ->where('isdelete',0)
								 ->find();
		$permission = json_decode($group->params,true);
		$arr_right = array();
		foreach($gc_menus as $item){
			if(isset($permission[$item->id])){
				$arr_right[$item->route] = $permission[$item->id];
			}
		}
		return $arr_right;
	}
    function SetTime($session) {
        $this->where('sessionid', "'" . $session . "'", false)->update(array('time' => gmdate("Y-m-d H:i:s", time() + 7 * 3600)));
    }
}

?>