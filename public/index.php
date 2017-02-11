<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-activetype
 */
namespace Jungle\Typeflect;
use Jungle\Typeflect\Types\CaseType;
use Jungle\Typeflect\Types\SimpleType;

include '../vendor/autoload.php';


echo '<h1>Integer Type:</h1>';

$type = new SimpleType('[+\-]?[1-9][0-9]*',Typeflect::TYPE_INT);

echo '<h2>Perceive:</h2>';
echo '<pre>Input: ';
var_dump($input = '-47');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';

echo '<h2>Stringify:</h2>';
echo '<pre>Input: ';
var_dump($input = -47);
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->stringify($input));
echo '</pre>';

echo '<h2>Self-Analyzing:</h2>';
echo '<pre>';
echo "\r\n Pattern: ";
echo $type->getPattern();
echo "\r\n Variable type (phptype): ";
echo $type->getVartype();
echo '</pre>';

echo '<h2>Assert Exception:</h2>';
echo '<pre>Input: ';
var_dump($input = 'abc');
echo '</pre>';
echo '<pre>Output: ';
try{
	var_dump($type->perceive($input));
}catch(TypeflectException $e){
	echo 'Exception: '.$e->getMessage();
}
echo '</pre>';



echo '<h1>String custom Type:</h1>';

$type = new SimpleType('\w+[\._\w]+@[\w_\.]+');
echo '<h2>Perceive:</h2>';
echo '<pre>Input: ';
var_dump($input = 'email@email');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';

echo '<h2>Stringify:</h2>';
echo '<pre>Input: ';
var_dump($input = 'email@email.com');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->stringify($input));
echo '</pre>';


echo '<h1>Boolean CaseType:</h1>';

$type = new CaseType([
	'on' =>true,
	'off'=>false,
],Typeflect::TYPE_BOOL, 'i');
echo '<h2>Perceive:</h2>';
echo '<pre>Input: ';
var_dump($input = 'on');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';
echo '<pre>Input: ';
var_dump($input = 'ON');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';
echo '<pre>Input: ';
var_dump($input = 'OFF');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';



// Multi choices
$type = new CaseType([
	'on'    => true,
	'off'   => false,

	'+'     => true,
	'-'     => false,

	'1'     => true,
	'0'     => false,

	'yes'   => true,
	'no'    => false,

	'true'  => true,
	'false' => false,
],'boolean', 'i');
echo '<h2>Perceive:</h2>';
echo '<pre>Input: ';
var_dump($input = 'on');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';
echo '<pre>Input: ';
var_dump($input = 'ON');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';
echo '<pre>Input: ';
var_dump($input = 'OFF');
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->perceive($input));
echo '</pre>';

echo '<h2>Stringify:</h2>';
echo '<pre>Input: ';
var_dump($input = true);
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->stringify($input));
echo '</pre>';
echo '<pre>Input: ';
var_dump($input = false);
echo '</pre>';
echo '<pre>Output: ';
var_dump($type->stringify($input));
echo '</pre>';

echo '<h2>Assert Exception:</h2>';
echo '<pre>Input: ';
var_dump($input = 'abc');
echo '</pre>';
echo '<pre>Output: ';
try{
	var_dump($type->perceive($input));
}catch(TypeflectException $e){
	echo 'Exception: '.$e->getMessage();
}
echo '</pre>';
