<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-typeflect
 */

namespace Jungle\Typeflect\Tests;

use Jungle\Typeflect\Types\CaseType;

/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class CaseTypeTest
 * @package Jungle\Typeflect\Tests
 */
class CaseTypeTest extends \PHPUnit_Framework_TestCase{

	public function testBool(){
		// Simple
		$type = new CaseType([
			'on'    => true,
			'off'   => false,
		],'boolean');

		$this->assertEquals(true, $type->perceive('on'));
		$this->assertEquals(false, $type->perceive('off'));

		$this->assertEquals('on', $type->stringify(true));
		$this->assertEquals('off', $type->stringify(false));
	}


	public function testBoolInsensitive(){
		// Case insensitive perceive
		$type = new CaseType([
			'on'    => true,
			'off'   => false,
		],'boolean','i');

		$this->assertEquals(true, $type->perceive('on')     , 'on');
		$this->assertEquals(false, $type->perceive('off')   , 'off');

		$this->assertEquals(true, $type->perceive('ON')     , 'ON');
		$this->assertEquals(false, $type->perceive('OFF')   , 'OFF');

		$this->assertEquals('on', $type->stringify(true));
		$this->assertEquals('off', $type->stringify(false));
	}


	public function testBoolMultiple(){
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
		],'boolean');

		$this->assertEquals(true, $type->perceive('on')     , 'on');
		$this->assertEquals(false, $type->perceive('off')    , 'off');

		$this->assertEquals(true, $type->perceive('+')      , '+');
		$this->assertEquals(false, $type->perceive('-')      , '-');

		$this->assertEquals(true, $type->perceive('1')      , '1');
		$this->assertEquals(false, $type->perceive('0')      , '0');

		$this->assertEquals(true, $type->perceive('yes')    , 'yes');
		$this->assertEquals(false, $type->perceive('no')     , 'no');

		$this->assertEquals(true, $type->perceive('true')   , 'true');
		$this->assertEquals(false, $type->perceive('false')  , 'false');

		// only on | off because positional at first in defined cases array
		$this->assertEquals('on', $type->stringify(true));
		$this->assertEquals('off', $type->stringify(false));
	}

	public function testBoolMultipleInsensitive(){
		// Multi choices with CaseInsensitive
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
		],'boolean','i');

		$this->assertEquals(true, $type->perceive('on')     , 'on');
		$this->assertEquals(false, $type->perceive('off')    , 'off');

		$this->assertEquals(true, $type->perceive('+')      , '+');
		$this->assertEquals(false, $type->perceive('-')      , '-');

		$this->assertEquals(true, $type->perceive('1')      , '1');
		$this->assertEquals(false, $type->perceive('0')      , '0');

		$this->assertEquals(true, $type->perceive('yes')    , 'yes');
		$this->assertEquals(false, $type->perceive('no')     , 'no');

		$this->assertEquals(true, $type->perceive('true')   , 'true');
		$this->assertEquals(false, $type->perceive('false')  , 'false');


		$this->assertEquals(true, $type->perceive('ON')     , 'ON');
		$this->assertEquals(false, $type->perceive('OFF')    , 'OFF');

		$this->assertEquals(true, $type->perceive('YES')    , 'YES');
		$this->assertEquals(false, $type->perceive('NO')     , 'NO');

		$this->assertEquals(true, $type->perceive('TRUE')    , 'TRUE');
		$this->assertEquals(false, $type->perceive('FALSe')   , 'FALSe');

		// only on | off because positional at first in defined cases array
		$this->assertEquals('on', $type->stringify(true), 'convert boolean TRUE to string: must be "on"');
		$this->assertEquals('off', $type->stringify(false), 'convert boolean FALSE to string: must be "off"');
	}

	public function testBoolUtfInsensitive(){
		// UTF case insensitive
		$type = new CaseType([
			'Да' => true,
			'Нет' => false,
		],'boolean','ui');

		$this->assertEquals(true, $type->perceive('да')    , 'да');
		$this->assertEquals(false, $type->perceive('нет')     , 'нет');

		$this->assertEquals(true, $type->perceive('ДА')    , 'ДА');
		$this->assertEquals(false, $type->perceive('НЕТ')     , 'НЕТ');

		$this->assertEquals(true, $type->perceive('Да')    , 'Да');
		$this->assertEquals(false, $type->perceive('Нет')     , 'Нет');

		$this->assertEquals('Да', $type->stringify(true));
		$this->assertEquals('Нет', $type->stringify(false));
	}
}


