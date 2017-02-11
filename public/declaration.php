<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-activetype
 */
include '../vendor/autoload.php';


/**
 * @activetype(
 *     name: 'int';
 *     pattern: '[\+\-]?[1-9][0-9]*';
 *     vartype: 'integer'
 * )
 */
$type = new \Jungle\Activetype\Type(
	'int',
	'[\+\-]?[1-9][0-9]*',
	'integer'
);

echo '<h2>From php-value (integer):</h2>';

$php_value_source = 47;
echo '<div>Source value (start php-value): </div>';
echo '<pre>';
var_dump($php_value_source);
echo '</pre>';

$string_reflection = $type->render($php_value_source);
echo '<div>Reflect to string (rendered from php-value): </div>';
echo '<pre>';
var_dump($string_reflection);
echo '</pre>';

$php_value = $type->evaluate($string_reflection);
echo '<div>Reflected backward (evaluated from text to php-value): </div>';
echo '<pre>';
var_dump($php_value);
echo '</pre>';


echo '<h2>Parsing custom input from string (integer):</h2>';
$input_string = '-47';
echo '<div>Input string: </div>';
echo '<pre>';
var_dump($input_string);
echo '</pre>';


$evaluated = $type->evaluate($input_string);
echo '<div>Evaluated input: </div>';
echo '<pre>';
var_dump($evaluated);
echo '</pre>';




/**
 * @activetype(
 *     name: 'int';
 *     pattern: '[\+\-]?[1-9][0-9]*';
 *     vartype: 'integer'
 * )
 */
$type = new \Jungle\Activetype\Type(
	'boolean',
	'[\+\-]?[1-9][0-9]*',
	'integer'
);

echo '<h2>From php-value (integer):</h2>';

$php_value_source = 47;
echo '<div>Source value (start php-value): </div>';
echo '<pre>';
var_dump($php_value_source);
echo '</pre>';

$string_reflection = $type->render($php_value_source);
echo '<div>Reflect to string (rendered from php-value): </div>';
echo '<pre>';
var_dump($string_reflection);
echo '</pre>';

$php_value = $type->evaluate($string_reflection);
echo '<div>Reflected backward (evaluated from text to php-value): </div>';
echo '<pre>';
var_dump($php_value);
echo '</pre>';


echo '<h2>Parsing custom input from string (integer):</h2>';
$input_string = '-47';
echo '<div>Input string: </div>';
echo '<pre>';
var_dump($input_string);
echo '</pre>';


$evaluated = $type->evaluate($input_string);
echo '<div>Evaluated input: </div>';
echo '<pre>';
var_dump($evaluated);
echo '</pre>';