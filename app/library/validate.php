<?php 
/**
 * 
 */
class Validate 
{
	public function isName($name = '')
	{
		return (preg_match("/^[A-Za-záéíóúñÑüÁÉÍÓÚÜNIÑOniñoN\sN]*$/", $name)) ? true : false;
	}

	public function isNumber($number = '')
	{
		return (preg_match("/^([0-9])*$/", $number)) ? true : false;
	}

	public function isEmail($email = '')
	{
		$email = trim($email);
		$email = strtolower($email);
		return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
	}

	public function isDateAndTime($dateAndTime = '')
	{
		$regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})(\s)([0-1][0-9]|2[0-3])(:)([0-5][0-9])$/';
        return (preg_match($regexFecha, $dateAndTime)) ? true : false;
	}

	public function isDate($date='')
	{
		$regexFecha='/^((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))-((0[13578])|(1[02]))-((0[1-9])|([12][0-9])|(3[01])))|((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))-((0[469])|11)-((0[1-9])|([12][0-9])|(30)))|(((000[48])|([0-9][0-9](([13579][26])|([2468][048])))|([0-9][1-9][02468][048])|([1-9][0-9][02468][048]))-02-((0[1-9])|([12][0-9])))|((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))-02-((0[1-9])|([1][0-9])|([2][0-8])))$/';
        return (preg_match($regexFecha, $date)) ? true : false;
	}

	public function removeBlankSpaces($str='')
	{
		$str=trim($str);
        $str = stripslashes($str);
        $str=htmlspecialchars($str);
        return $str;
	}

	public function firstUpper($str='')
	{
		$str=trim($str);
		$str = stripslashes($str);
		$str=htmlspecialchars($str);
		$str = ucwords($str);
		return $str;
	}

} ?>