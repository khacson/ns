<?php
/**
 * @author Sonnk
 * @copyright 2016
 */
 
class incModelMenu extends CI_Model{

	function __construct(){
		parent::__construct('');
	}
	function getMenu($groupid){	
		$login = $this->site->getSession("glogin");
		$processid = $login['processid'];
		#region Phan quyen
		$sqlGroup = "SELECT g.id as groupid, g.params
			FROM hre_groups g
			WHERE g.isdelete = 0
			AND g.id = '$groupid'
			";	
		$params = $this->model->query($sqlGroup)->execute();
		$permission = json_decode($params[0]->params);
		$right  = '';
		if(count($permission) == 0){
			return ""; 
		}
		foreach($permission as $key => $val){
			$right.= ",".$key;
		}
		$right = substr($right,1);
		$controller = 'route';
		$sql = "
				select gm.name as pagename, gm.ordering, gm.route as controller, gm.classicon as classs, gm.id as pageid
				from hre_menus gm
				where gm.parent = 0
				and gm.isdelete = 0
				and gm.isshow = 1
				/*and gm.id in ($right)*/
				order by gm.ordering asc
		";
		$parent_menu = $this->model->query($sql)->execute();
		$uri = $this->uri->segment(1);			
		$Actives = $this->getActive();
		$arrActive1 = $Actives['array'];
		$arrActive = $Actives['array2']; 
		$menu = '';
		$i=1;
		foreach($parent_menu as $item){
			$active = '';
			if(empty($uri) || $uri == 'home'){
				if($i==1){
					$active = 'active';		
				}
			}
			else{
				if(isset($arrActive1[$uri]) && $arrActive1[$uri] == $item->pageid){
					$active = 'active';		
				}
			}
			$asub = $this->getChildren($item->pageid,$groupid,$right,$arrActive);
			//print_r($asub); 
            if($asub){
				$menu.= '<li class="'.$active.' treeview">';
				$menu.= '<a href="#">';
				$menu.= '<i class="fa '.($item->classs).'"></i>';
				$menu.= '<span>'.($item->pagename).'</span>';
				$menu.= '<span class="pull-right-container">';
				$menu.= '<i class="fa fa-angle-left pull-right"></i>';
				$menu.= '</span';
				$menu.= '</a>';
				$menu.= '<ul class="treeview-menu">';
				$menu.= $asub;
				$menu.= '</ul>';
				$menu.= '</li>';
			}
			else{
				if(!empty($item->classs)){
					$icon = $item->classs;
				}
				else{
					$icon = 'fa-circle-o';
				}
				if($uri == $item->controller){
					$active = 'active';		
				}
				else{
					$active = '';	
				}
				$menu.= '<li class="'.$active.'">';
				$menu.= '<a href="'.base_url().($item->controller).'.html">';
				$menu.= '<i class="fa '.$icon.'"></i><span>'.($item->pagename).'</span>';
				$menu.= '</a>';
				$menu.= '</li>';
			}
			$i++;
		}
		return $menu;	
    }
    private function getChildren($id,$groupid,$right,$arrActive){
		$processid = $this->login['processid'];
		$sql = "
				select gm.name as pagename, gm.ordering, gm.route as controller, gm.classicon as classs, 
				gm.id as pageid, gm.processid
				from hre_menus gm
				where gm.parent = '$id'
				and gm.isdelete = 0
				and gm.isshow = 1
				and gm.id in ($right)
				order by gm.ordering asc
		";
		$children = $this->model->query($sql)->execute();
		$uri = $this->uri->segment(1);		
        $menu = '';
		foreach($children as $item){
			 if(isset($arrActive[$uri]) && $arrActive[$uri] == $item->pageid){
				 $active = 'active';		
			 }
			 else{
				 $active = '';		
			 }
			 $asub = $this->getChildren($item->pageid,$groupid,$right,$arrActive);   
			 if($asub){
				$menu.= '<li class="'.$active.'">';
				$menu.= '<a href="#"><i class="fa '.($item->classs).' "></i>';
				$menu.= $item->pagename;
				$menu.= '<span class="pull-right-container">';
				$menu.= '<i class="fa fa-angle-left pull-right"></i>';
				$menu.= '</span';
				$menu.= '</a>';
				$menu.= '<ul class="treeview-menu">';
				$menu.= $asub;
				$menu.= '</ul>';
				$menu.= '</li>';
			 }
			 else{
				 if(!empty($item->classs)){
					$icon = $item->classs;
				 }
				 else{
					$icon = 'fa-circle-o';
				 }
				 $controller = $item->controller;
				 $active = '';	
				 if($uri == $controller){
					$active = 'active';	
				 }
				 $menu.='<li class="'.$active.'">';
				 $menu.='<a href="'.base_url().$controller.'">';
				 $menu.='<i class="fa '.$icon.'"></i>';
				 $menu.= $item->pagename;
				 $menu.='</a>';
				 $menu.='</li>';
				 $menu.='';
			 }
		}
		return $menu;
    }
	function getActive(){
		$sql = "
			SELECT if((m.processid = 1 and m.route = 'process'),'receiving',m.route) as route, m.id, m.parent as parents,
			(select parent
				from hre_menus where id =  m.parent
			) as parent_node
			FROM hre_menus m 
			where m.isdelete = 0
			and m.parent <> 0
		";
		$query = $this->model->query($sql)->execute();
		$array = array();
		$array2 = array();
		foreach($query as $item){
			if(empty($item->parent_node)){
				$array[$item->route] = $item->parents;	
			}
			else{
				$array[$item->route] = $item->parent_node;	
			}
			$array2[$item->route] = $item->parents;	
		}
		$data['array'] = $array;
		$data['array2'] = $array2;
		return $data;
	}
}