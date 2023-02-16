<?php
/**
 * Esta clase contiene varios métodos que permiten validar diferentes tipos de datos.
 * 
 * @package Validate
 */
class Validate
{

	/**
	 * Comprueba si el nombre proporcionado solo contiene letras, espacios y caracteres acentuados.
	 * 
	 * @param string $name El nombre a validar
	 * @return bool Retorna true si el nombre es válido, de lo contrario, false
	 */
	public function isName($name = '')
	{
		return (preg_match("/^[A-Za-záéíóúñÑüÁÉÍÓÚÜNIÑOniñoN\sN]*$/", $name)) ? true : false;
	}

	/**
	 * Comprueba si el número proporcionado solo contiene dígitos numéricos.
	 * 
	 * @param string $number El número a validar
	 * @return bool Retorna true si el número es válido, de lo contrario, false
	 */
	public function isNumber($number = '')
	{
		return (preg_match("/^([0-9])*$/", $number)) ? true : false;
	}

	/**
	 * Comprueba si la dirección de correo electrónico proporcionada es válida.
	 * 
	 * @param string $email La dirección de correo electrónico a validar
	 * @return bool Retorna true si la dirección de correo electrónico es válida, de lo contrario, false
	 */
	public function isEmail($email = '')
	{
		$email = trim($email);
		$email = strtolower($email);
		return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
	}

	/**
	 * Comprueba si la fecha y hora proporcionada tienen el formato correcto.
	 * El formato válido es "dd/mm/aaaa hh:mm".
	 * 
	 * @param string $dateAndTime La fecha y hora a validar
	 * @return bool Retorna true si la fecha y hora tienen el formato correcto, de lo contrario, false
	 */
	public function isDateAndTime($dateAndTime = '')
	{
		$regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})(\s)([0-1][0-9]|2[0-3])(:)([0-5][0-9])$/';
		return (preg_match($regexFecha, $dateAndTime)) ? true : false;
	}

	/**
	 * Comprueba si la fecha proporcionada tiene el formato correcto.
	 * El formato válido es "aaaa-mm-dd".
	 * 
	 * @param string $date La fecha a validar
	 * @return bool Retorna true si la fecha tiene el formato correcto, de lo contrario, false
	 */
	public function isDate($date = '')
	{
		$regexFecha = '/^((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))-((0[13578])|(1[02]))-((0[1-9])|([12][0-9])|(3[01])))|((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))-((0[469])|11)-((0[1-9])|([12][0-9])|(30)))|(((000[48])|([0-9][0-9](([13579][26])|([2468][048])))|([0-9][1-9][02468][048])|([1-9][0-9][02468][048]))-02-((0[1-9])|([12][0-9])))|((([0-9][0-9][0-9][1-9])|([1-9][0-9][0-9][0-9])|([0-9][1-9][0-9][0-9])|([0-9][0-9][1-9][0-9]))-02-((0[1-9])|([1][0-9])|([2][0-8])))$/';
		return (preg_match($regexFecha, $date)) ? true : false;
	}

} ?>