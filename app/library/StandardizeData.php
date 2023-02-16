<?php
/**
 * La clase StandardizeData proporciona funciones para estandarizar y formatear datos.
 */
class StandardizeData
{
	/**
	 * Elimina los espacios en blanco innecesarios y los caracteres especiales de una cadena.
     * 
     * @param string $str La cadena a formatear.
     * @return string La cadena formateada sin espacios en blanco innecesarios y caracteres especiales.
	 */
	public function removeBlankSpaces($str = '')
	{
		$str = trim($str);
		$str = stripslashes($str);
		$str = htmlspecialchars($str);
		return $str;
	}

	/**
	 * Convierte la primera letra de cada palabra en mayúsculas y el resto en minúsculas.
     * 
     * @param string $str La cadena a formatear.
     * @return string La cadena formateada con la primera letra de cada palabra en mayúsculas y el resto en minúsculas.
	 */
	public function firstUpper($str = '')
	{
		$str = trim($str);
		$str = stripslashes($str);
		$str = htmlspecialchars($str);
		$str = ucwords($str);
		return $str;
	}
}
?>