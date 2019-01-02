<?php

namespace Collectify\Services;

class Viewer
{
	private $viewPath;
	private $viewParameters;
	private $controllerParameters;
	private $dynamizer;

	public function __construct()
	{
		$this->dynamizer = new Dynamizer();
	}

	public function setViewParameters($parameters)
	{
		$this->viewParameters = $parameters;
		return $this;
	}

	public function setControllerParameters($parameters)
	{
		$this->controllerParameters = $parameters;
		return $this;
	}

	public function render()
	{
		$this->creatPath();
		$view = file_get_contents($this->viewPath);
		$html = file_get_contents('../src/Collectify/Views/Layout/header.html');
		$html .= $this->dynamizer
			->setParameters($this->controllerParameters)
			->setView($view)
			->dynamize();
		$html .= file_get_contents('../src/Collectify/Views/Layout/footer.html');
		echo $html;
	}

	public function creatPath()
	{
		list($controller, $action) = $this->viewParameters;
		$viewPathString = sprintf('../src/Collectify/Views/%s/%s.html', $controller, $action);

		if(!file_exists($viewPathString)) {
			throw new \Exception("File $viewPathString not found");
		}
		
		$this->viewPath = $viewPathString;
	}
}