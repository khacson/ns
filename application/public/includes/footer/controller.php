<?php
/**
 * @author Sonnk
 * @copyright 2011
 */
 
class incFooter extends CI_Include
{
	function __construct()
	{
	    parent::__construct();
		$this->load->incModel("base_model");
		
		$data = new stdClass();
		$this->load->incView($data);
		
	}
}