<?php

namespace Collectify\Controller;

use Collectify\Model\CategoryRepository;
use Collectify\Form\CategoryForm;
use Collectify\Form\Handler\FormHandler;

class CategoryController
{
	public function listAction()
	{
		return array();
	}

	public function addAction()
	{
		$formHandler = new FormHandler(CategoryRepository::TYPE);
		$form        = $formHandler->getForm();
		
		if($formHandler->handle(FormHandler::CREATE)){
			$redirect = sprintf('Location: app.php?controller=%s&action=list', CategoryRepository::TYPE);
			header($redirect);
		}

		return array('form' => $form->render());
	}
	
	public function editAction($id)
	{
		$repository  = new CategoryRepository();
		$category    = $repository->load($id);
		$data        = $category->getProperties();
		$formHandler = new FormHandler(CategoryRepository::TYPE, $data);
		$formHandler->setObject($category);
		$form        = $formHandler->getForm();
		
		if($formHandler->handle(FormHandler::UPDATE)){
			$redirect = sprintf('Location: app.php?controller=%s&action=list', CategoryRepository::TYPE);
			header($redirect);
		}

		return array('form' => $form->render());
	}

	/*
	 * Show infos
	 */
	public function showAction($id)
	{
		$repository  = new CategoryRepository();
		$category    = $repository->load($id);
		
		return array('category' => $category);
	}

	public function removeAction($id)
	{
		$repository  = new CategoryRepository();
		$repository->remove($id);
		$redirect = sprintf('Location: app.php?controller=%s&action=list', CategoryRepository::TYPE);
		header($redirect);
	}
}
