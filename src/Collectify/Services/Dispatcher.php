<?php

namespace Collectify\Services;

class Dispatcher
{
	private $parameters;
	private $viewer;
	private $controller;
	private $action;

	public function __construct()
	{
		$this->parameters = $_GET;
		$this->viewer = new Viewer();
	}

	public function dispatch()
	{
		$parameters = $this->extractControllerAndActionParameters();
		$controllerParamters = $this->executeAction();

		$this->viewer
			->setViewParameters($parameters)
			->setControllerParameters($controllerParamters)
			->render();
	}

	private function extractControllerAndActionParameters()
	{
		$this->controller = array_key_exists('controller', $this->parameters) ? $this->parameters['controller'] : DEFAULT_CONTROLLER;
		$this->action = array_key_exists('action', $this->parameters) ? $this->parameters['action'] : DEFAULT_ACTION;

		return array($this->controller, $this->action);
	}

	public function executeAction()
	{
		$controllerClass = sprintf('\\Collectify\\Controller\\%sController', ucfirst($this->controller));

		if(!class_exists($controllerClass)){
			throw new \Exception("Class $controllerClass not found.");
		}

		$controller = new $controllerClass();
		$action = sprintf('%sAction', $this->action);
		if(!method_exists($controllerClass, $action)){
			throw new \Exception("Action $action not found in class $controllerClass not found.");
		}
		$this->cleanGetParameters();
		return call_user_func_array(array($controller, $action), $this->parameters);
	}

	private function cleanGetParameters()
	{
		switch(true){
			case array_key_exists('controller', $this->parameters):
				unset($this->parameters['controller']);
			case array_key_exists('action', $this->parameters):
				unset($this->parameters['action']);
		}
	}
}
