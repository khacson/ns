<?php
/**
 * @author Sonnk
 * @copyright 2016
 */
 
class incMenu extends CI_Include
{
	function __construct()
	{
	    parent::__construct();
		$this->load->incModel();
		$data = new stdClass();
		$login = $this->site->getSession("glogin");
		$groupid = $login['groupid']; 
		$data->fullname = $login['fullname'];
		$data->avatar = $login['avatar'];
		$data->login = $login;
		$data->menus =  $this->model->getMenu($groupid); 
		$this->load->incView($data);
	}
}