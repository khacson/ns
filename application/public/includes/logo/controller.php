<?php
/**
 * @author Sonnk
 * @copyright 2015
 */
 
class incLogo extends CI_Include
{
	function __construct()
	{
	    parent::__construct();
		$login = $this->load->site->GetSession('login');
		$key = "VN510";
		$string = json_encode($login);
		$data = new stdClass();
		$str = $this->encode($key,trim($string));
		$decode = str_replace("+","___",$str);
		$data->server = base_url().'home';
		 //https://gce.greystonevn.com
		$this->load->incView($data);
	}
	function encode($key,$string) {
		 $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
		 $padding = $block - (strlen($string) % $block);
		 $string .= str_repeat(chr($padding), $padding);
		 //$crypted_text = mcrypt_encrypt(MCRYPT_RIJNDAEL_128,$key,$string,MCRYPT_MODE_ECB);
		 //$encode =  base64_encode($crypted_text);
		 return "";//$encode;
    }
}