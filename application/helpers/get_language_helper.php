<?php
	//ham lay ngon ngu tu session
	function getLanguage($type="",$key=""){
		$language =  $_SESSION['language_'];
		if(isset($language[$type][$key])){
			return $language[$type][$key];
		}
		else{
			return $key;
		}
	}




?>