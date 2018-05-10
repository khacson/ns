<?php
/**
 * @author Sonnk
 * @copyright 2013
 */

class AuthorizeModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function getLanguage(){
		$query = $this->model->table('');
	}
}