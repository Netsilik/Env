<?php
namespace Netsilik\Helpers\functions;

/**
 * @copyright (c) 2011-2016 Netsilik (http://netsilik.nl)
 * @license       EUPL-1.1 (European Union Public Licence, v1.1)
 */

/**
 * Gets the value of an environment variable. Supports boolean, int, float and null.
 *
 * @param string $key
 *
 * @return mixed
 */
function env($key)
{
	$value = getenv($key);
	if ($value === false) {
		trigger_error('Environment variable ' . $key . ' does not exist', E_USER_WARNING);
		
		return null;
	}
	
	if (substr($value, 0, 1) === '"' && substr($value, -1, 1) === '"') { // A quoted value is always a string
		return substr($value, 1, -1);
	}
	
	switch (strtolower($value)) {
		case 'true':
			return true;
		case 'false':
			return false;
		case 'null':
			return null;
	}
	
	if (is_numeric($value)) {
		if ((int) $value == (float) $value) {
			return (int) $value;
		}
		
		return (float) $value;
	}
	
	return $value; // string
}
