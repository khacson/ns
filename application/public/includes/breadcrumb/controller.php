<?php

/**
 * @author Sonnk
 * @copyright 2016
 */
class incBreadcrumb extends CI_Include {

    function __construct() {
        parent::__construct();
        $this->load->incModel();
		$data = new stdClass();
		$controller = $this->uri->segment(1);
		$this->site->SetSession("ctl", $controller);
		$processid = 0;
		if(isset($_GET['prs'])){
			$processid = $_GET['prs'];
		}
		$menu = $this->model->table('hre_menus')
							->select('id,keylang,parent as pr')
							->where('route',$controller)
							->where('processid',$processid)
							->find(); 
		if(empty($menu->pr)){
			if(!empty($menu->id)){
				$data->pagename = '<li class="active">'.getLanguage($menu->keylang).'</li>';
			}
			else{
				$data->pagename = '';
			}
		}
		else{
			$parent = $this->model->table('hre_menus')
							->select('id,keylang,parent as pr')
							->where('id',$menu->pr)
							->find();
			$data->pagename = '<li><a href="#"><i class="fa fa-folder-open-o" aria-hidden="true"></i>
 '.getLanguage($parent->keylang).'</a></li><li class="active">'.getLanguage($menu->keylang).'</li>';
		}
		$this->load->incView($data);
    }

}