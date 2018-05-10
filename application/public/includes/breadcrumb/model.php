<?php
/**
 * @author Sonnk
 * @copyright 2016
 */
 
class incModelBreadcrumb extends CI_Model{
	function __construct(){
		parent::__construct();
		
	}
	function getBreadCrumb($controller,$processid) {
		if($controller == 'home'){
			return '<li></li>';
		}
		$controller2 = $controller;
		$sql = "
			SELECT id, parent, name,keylang,route
			FROM hre_menus 
			WHERE route = '$controller' 
			AND processid = '$processid'
			AND isdelete = 0;
		";
		$pid = $this->model->query($sql)->execute();
		if(empty($pid[0]->name)){
			return '<li></li>';
		}
		$arr = array();
		$blist = array();
		$blist[$pid[0]->id] = 1;
		$breadcrumb = '';
		$this->getParent($pid[0]->parent, $arr, $blist);
		$c = count($arr) - 1;
		for ($i = $c; $i >= 0; $i--) {
			$breadcrumb .= $arr[$i];
		}
		$pagename = $pid[0]->name; 
		$route = $pid[0]->route;
		$breadcrumb .= '<li ><a href="'.base_url().$route.'" style="color:#3399FF">'.$pagename.'</a></li>';
		$this->site->SetSession("selected_item_menu", $pid[0]->id);
		$this->site->SetSession("blist", $blist);
		// print_r($blist); exit;
		return $breadcrumb;
	}

	function getParent($id, &$arr, &$blist) {
		$sql = "
			SELECT id, route, name, parent ,keylang
			FROM hre_menus 
			WHERE id = '$id'
			AND isdelete = 0;
		";
		$parent = $this->model->query($sql)->execute();
		if (!$parent) return;
		$blist[$parent[0]->id] = 1;
		$pid = $parent[0]->parent;
		$route = $parent[0]->route;
		$pagename = $parent[0]->name;
		if($route != '' && $route != '#'){
			$link = base_url().$route;
		}else{
			$link = $route;
		}
		$breadcrumb = '<li><a href="'.$link.'">'.$pagename.'</a></li>';
		array_push($arr, $breadcrumb);
		$this->getParent($pid, $arr, $blist);
	}
}