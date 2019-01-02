<?php

namespace Collectify\Services;

class Dynamizer
{
	private $view;
	private $parameters;
	private $variables;
	private $helper;

	public function __construct()
	{
		$this->helper =  new Helper();
	}

	public function setParameters($parameters)
	{
		$this->parameters = $parameters;

		return $this;
	}

	public function setView($view)
	{
		$this->view = $view;
		
		return $this;
	}

	public function dynamize()
	{
		$this->searchVariables();
		$this->replaceVariables();

		return $this->view;
	}

	private function searchVariables()
	{
		preg_match_all('/{{([^}]+)}}/', $this->view, $variables);
	
		foreach($variables[0] as $key => $variable){
			$this->variables[$variable] =  trim($variables[1][$key]);
		}
	}

	private function replaceVariables()
	{
		if(empty($this->variables)){
			return;
		}

		foreach($this->variables as $pattern => $key){
			$isFunction = preg_match('/\((.*)\)/', $key);
			$isObject = preg_match('/\./', $key);

			switch(true){
				case $isFunction:
					preg_match_all('/(.*)\((.*)\)/', $key, $helperParameters);
					$pattern = preg_replace(array('/\(/', '/\)/'), array('\(', '\)'), $pattern);
					$method = array_pop($helperParameters[1]);
					$parameters = array_pop($helperParameters[2]);
					$parameters = !$parameters ? array() : explode(',', $parameters);
					$parameters = array_map('trim', $parameters);
					$value = call_user_func_array(array($this->helper, $method), $parameters);
					break;
				case $isObject:
					list($key, $property) = explode('.', $key);
					$this->verifyKeyInParameters($key);

					$object = $this->parameters[$key];
					$value = $object->$property;
					break;
				default:
					$this->verifyKeyInParameters($key);
					$value = $this->parameters[$key];
			}

			$regexPattern = sprintf('/%s/', $pattern);
			$this->view = preg_replace($regexPattern, $value, $this->view);
		}
	}

	private function verifyKeyInParameters($key)
	{
		if(!array_key_exists($key, $this->parameters)){
			throw new \Exception("Parameter $key not found.");
		}
	}	
	
}