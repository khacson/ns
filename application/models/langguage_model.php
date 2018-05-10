<?php

/** * @author SonNguyen * @copyright 2015 */
class langguage_model extends CI_Model {

    function __construct() {
        parent::__construct('');
        $this->load->model();
    }
	function getLanguage($lang){
		$query = $this->model->table('phone_language_pubic')
					  ->select('keyword,translation')
					  ->where('isdelete',0)
					  ->where('languagecode',$lang)
					  ->find_all();
		return $query;
	}
}
?>