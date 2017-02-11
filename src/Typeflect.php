<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-typeflect
 */

namespace Jungle\Typeflect;

/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class Typeflect
 * @package Jungle\Typeflect
 *
 * Тип который формирует шаблон кастомно, так-же происходит и со стрингификацией, с поддержкой arguments и без них
 * Тип который использует статичный шаблон для perceive и простое приведение к строке для stringify
 *
 * Паттерны.
 * PHP Приведение типов
 * CASE 'true' => true && 'false' => false | 1 => true && 0 => false
 *
 */
interface Typeflect{

	const TYPE_STR      = 'string';
	const TYPE_INT      = 'integer';
	const TYPE_FLOAT    = 'double';
	const TYPE_BOOL     = 'boolean';
	const TYPE_ARRAY    = 'array';
	const TYPE_OBJECT   = 'object';

	const TYPE_NULL     = 'null';

	/**
	 * pcre pattern without wrap /.../mod
	 * @return string
	 */
	public function getPattern();

	/**
	 * Jungle\Typeflect\Typeflect::TYPE_* constants
	 * @return mixed
	 */
	public function getVartype();
	
	/**
	 * Воспринимать из строки
	 * @param $string
	 * @return mixed
	 */
	public function perceive($string);

	/**
	 * Конверировать в строку
	 * @param $value
	 * @return string
	 */
	public function stringify($value);
}


