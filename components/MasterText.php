<?php

class MasterText
{
	
	var $lang;
	var $verbose;
	var $messages;
	var $messagesPlural;
	
	function __construct($lang,$verbose = false)
	{
		$this->verbose = $verbose;
		$this->lang = $lang;
		$path = dirname(__FILE__) ."/../languages/".$lang.".php";
		if(!file_exists($path))
		{
			if($this->verbose) echo "<strong>Warning</strong> file  \"".$lang.".php\" don't exists";
		}
		require_once($path);
		$this->messages = $messages;
		$this->messagesPlural = $messagesPlural;
	}
	
	function getMasterText($key)
	{
		if(isset($this->messages[$key]))
		{
			echo $this->messages[$key];
			return $this->messages[$key];
		}
		else
		{
			if($this->verbose) echo "the word is not setting in this file ";
			//key not allowed
			echo $key;
			return $key;
		}
		
		
	}
	
	function getMasterTextPlural($key)
	{
		if(isset($this->messagesPlural[$key]))
		{
			echo $this->messagesPlural[$key];
			return $this->messagesPlural[$key];
		}
		else
		{
			if($this->verbose) echo "the word is not setting in this file ";
			//key not allowed
			echo $key;
			return $key;
		}
		
		
	}
	
	
	function _($key)//call quicly getMasterText
	{
		$this->getMasterText($key);
	}
	
	function __($key)//call quicly getMasterTextPlural
	{
		$this->getMasterTextPlural($key);
	}
	
}

//test
/*

$m = new MasterText("en",true);

$m->_("hello");

$m->__("hello");

*/
?>