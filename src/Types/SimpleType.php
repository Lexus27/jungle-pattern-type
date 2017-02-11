<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-typeflect
 */

namespace Jungle\Typeflect\Types;
use Jungle\Regex\RegexUtils;
use Jungle\Typeflect\Typeflect;
use Jungle\Typeflect\TypeflectException;


/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class SimpleType
 * @package Jungle\Typeflect
 */
class SimpleType implements Typeflect{

	/** @var  string */
	protected $pattern;

	/** @var  string */
	protected $vartype = Typeflect::TYPE_STR;

	private $_pcre_pattern;

	/**
	 * SimpleType constructor.
	 * @param $pattern
	 * @param string $vartype
	 */
	public function __construct($pattern, $vartype = Typeflect::TYPE_STR){
		$this->pattern = $pattern;
		$this->vartype = $vartype;
	}

	/**
	 * pcre pattern
	 * @return string
	 */
	public function getPattern(){
		return $this->pattern;
	}

	/**
	 * Jungle\Typeflect\Typeflect::TYPE_* constants
	 * @return mixed
	 */
	public function getVartype(){
		return $this->vartype;
	}

	/**
	 * Воспринимать из строки
	 * @param $string
	 * @return mixed
	 * @throws TypeflectException
	 */
	public function perceive($string){
		if(!$this->match($string)){
			// mismatch
			throw TypeflectException::mismatchInput($this, $this->getPattern(), $string);
		}
		return $this->_doPerceive($string);
	}


	/**
	 * Конверировать в строку
	 * @param $value
	 * @return string
	 * @throws TypeflectException
	 */
	public function stringify($value){
		$value = $this->_doStringify($value);
		if(!$this->match($value)){
			throw TypeflectException::mismatchOutput($this, $this->getPattern(), $value);
		}
		return $value;
	}

	/**
	 * @param $string
	 * @return bool
	 */
	public function match($string){
		$pattern = $this->getPattern();
		if(!$this->_pcre_pattern){
			$this->_pcre_pattern = RegexUtils::to_pcre($pattern);
		}
		if(!preg_match($this->_pcre_pattern,$string)){
			// не соответствие строки с шаблоном
			return false;
		}
		return true;
	}




	/**
	 * @param $string
	 * @return mixed
	 */
	protected function _doPerceive($string){
		settype($string, $this->vartype);
		return $string;
	}
	/**
	 * @param $value
	 * @return mixed
	 */
	protected function _doStringify($value){
		settype($value, Typeflect::TYPE_STR);
		return $value;
	}


}


