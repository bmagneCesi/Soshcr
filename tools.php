<?php 

/**
* 
*/
class Tools
{

	static function toUrl($string)
	{
	  $string = preg_replace('`\s+`', '_', trim($string));
	  $string = str_replace("'", "_", $string);
	  $string = preg_replace('`_+`', '_', trim($string));
	  $url=strtr($string,
	"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
	                        "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn")
	;
	  return ($url);
	}

}

 ?>