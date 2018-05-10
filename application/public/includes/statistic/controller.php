<?php
/**
 * @author Sonnk
 * @copyright 2011
 */
 
class incStatistic extends CI_Include
{
	function __construct()
	{
	    parent::__construct();
		$this->load->incModel();
		$CI =& get_instance();
		//print_r();
		//$this->load->incLang($this->site->lang);
		$data = new stdClass();
		$data->csrfName = $CI->security->get_csrf_token_name();
		$data->csrfHash = $CI->security->get_csrf_hash();
		$this->load->incView($data);
	}
}