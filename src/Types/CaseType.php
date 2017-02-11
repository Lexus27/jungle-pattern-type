<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: php-text-typeflect
 */

namespace Jungle\Typeflect\Types;
use Jungle\Regex\RegexUtils;
use Jungle\Typeflect\TypeflectException;


/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class CaseType
 * @package Jungle\Typeflect
 */
class CaseType extends SimpleType{


	/** @var array  */
	protected $cases = [];
	/** @var  array */
	protected $cases_strings = [];
	/** @var  array */
	protected $cases_defaults = [];
	/** @var array  */
	protected $modifiers;
	/** @var  string|null */
	protected $pattern;

	/**
	 * CaseType constructor.
	 * @param array $cases
	 * @param string $vartype
	 * @param null $modifiers
	 * @param array $defaults
	 */
	public function __construct(array $cases, $vartype, $modifiers = null, array $defaults = null){
		$strings = false;
		foreach($cases as $string => $value){
			if(is_string($string) || $strings){
				$strings = true;
				if(false === $i = array_search($value, $this->cases)){
					$i = count($this->cases);
					$this->cases[$i] = $value;
				}
				$this->cases_strings[$i][] = (string)$string;
			}else{
				$this->cases[] = $value['value'];
				$this->cases_strings[] = $value['strings'];
			}
		}
		$this->modifiers = $modifiers;
		parent::__construct(null, $vartype);
		$this->cases_defaults = $defaults;
	}


	/**
	 * pcre pattern without wrap /.../mod
	 * @return string
	 */
	public function getPattern(){
		if(!$this->pattern){
			$a = [];
			foreach($this->cases as $i => $value){
				$strings    = $this->cases_strings[$i];
				if($strings){
					foreach($strings as & $str){
						$str = preg_quote($str);
					}
					$a = array_merge($a, $strings);
				}
			}
			$this->pattern = implode('|',$a);
			if($this->modifiers){
				$this->pattern = '(?'.$this->modifiers.':'.$this->pattern.')';
			}
		}
		return $this->pattern;
	}

	/**
	 * @param $string
	 * @return mixed
	 * @throws TypeflectException
	 */
	protected function _doPerceive($string){
		foreach($this->cases_strings as $i => $strings){
			foreach($strings as $variant){
				if(preg_match('@'.preg_quote($variant,'@').'@'.$this->modifiers, $string)){
					return parent::_doPerceive($this->cases[$i]);
				}
			}
		}
		throw new TypeflectException('Perceive: Is not recognized case for string "'.$string.'" ');
	}

	/**
	 * @param $value
	 * @return mixed
	 * @throws TypeflectException
	 */
	protected function _doStringify($value){
		$i = array_search($value, $this->cases, true);
		if($i === false){
			throw new TypeflectException('Stringify: Is not recognized case for value "'.$value.'" ');
		}
		if(isset($this->cases_defaults[$i])){
			return parent::_doStringify($this->cases_defaults[$i]);
		}
		return parent::_doStringify(current($this->cases_strings[$i]));
	}
}


