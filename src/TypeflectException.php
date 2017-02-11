<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-typeflect
 */

namespace Jungle\Typeflect;

/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class TypeflectException
 * @package Jungle\Typeflect
 */
class TypeflectException extends \Exception{

	/**
	 * @param Typeflect $type
	 * @param $pattern
	 * @param $value
	 * @return TypeflectException
	 */
	public static function mismatchInput($type, $pattern, $value){
		return new self(sprintf(
			'Mismatched input value: type "%s"; pattern "%s"; text "%s"',
			$type->getVartype(), $pattern, $value
		));
	}

	/**
	 * @param Typeflect $type
	 * @param $pattern
	 * @param $value
	 * @return TypeflectException
	 */
	public static function mismatchOutput($type, $pattern, $value){
		return new self(sprintf(
			'Mismatched output converted value: type "%s"; pattern "%s"; text "%s"',
			$type->getVartype(), $pattern, $value
		));
	}

}


