<?php
namespace Jungle\Typeflect\Tests;
use Jungle\Typeflect\Typeflect;
use Jungle\Typeflect\TypeflectException;
use Jungle\Typeflect\Types\SimpleType;

/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-typeflect
 */
class SimpleTypeTest extends \PHPUnit_Framework_TestCase{

	public function testInteger(){
		$type = new SimpleType('[+\-]?[1-9][0-9]*',Typeflect::TYPE_INT);
		$input = '-47';

		$this->assertEquals(-47, $type->perceive($input));

		$this->assertEquals($input, $type->stringify(-47));

		try{
			$type->perceive('');
		}catch(TypeflectException $e){
			$this->assertEquals(
				'Mismatched input value: type "integer"; pattern "[+\-]?[1-9][0-9]*"; text ""',
				$e->getMessage()
			);
		}
	}

	public function testString(){
		$type = new SimpleType('.+',Typeflect::TYPE_STR);
		$input = '-47';
		$this->assertEquals('-47', $type->perceive($input));
		$this->assertFalse($type->perceive($input) === -47);
	}

	public function testEmptyString(){
		$type = new SimpleType('.*',Typeflect::TYPE_STR);
		$input = '';
		$this->assertEquals('', $type->perceive($input));
	}

	public function testEmail(){

		$type = new SimpleType('\b\w+(?:[\-\.]\w+)*@\w+(?:[\-\.]\w+)*',Typeflect::TYPE_STR);

		$input = 'example-20.mailbox@gmail.com';
		$this->assertEquals($input, $type->perceive($input));
		$this->assertEquals($input, $type->stringify($input));

		$input = 'example-20.mailbox@gmail-hello.com';
		$this->assertEquals($input, $type->perceive($input));
		$this->assertEquals($input, $type->stringify($input));

		$input = 'example-20.mailbox@localhost';
		$this->assertEquals($input, $type->perceive($input));
		$this->assertEquals($input, $type->stringify($input));


		$input = 'example-20.mailbox@127.0.0.1';
		$this->assertEquals($input, $type->perceive($input));
		$this->assertEquals($input, $type->stringify($input));
	}

}


