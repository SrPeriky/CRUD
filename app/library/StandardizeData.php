<?php 
/**
 * 
 */
class StandardizeData
{
	public function removeBlankSpaces($str='')
	{
		$str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
	}

	public function firstUpper($str='')
	{
		$str = trim($str);
		$str = stripslashes($str);
		$str = htmlspecialchars($str);
		$str = ucwords($str);
		return $str;
	}
}
 ?>