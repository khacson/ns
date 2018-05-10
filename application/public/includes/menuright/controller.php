<?php
/**
 * @author Sonnk
 * @copyright 2011
 */
 
class incMenuright extends CI_Include
{
	function __construct()
	{
	    parent::__construct();
		$this->load->incModel();
		$data = new stdClass();
		$login = $this->site->getSession("glogin"); 
		$data->fullname = $login['fullname'];
		$data->avatar = $login['avatar'];
		$data->groupname = $login['groupname'];
		$data->countTransfer = 0;
		$data->countWip = 0;
		$data->total = 0;
		$this->load->incView($data);
	}
}