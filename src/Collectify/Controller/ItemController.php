<?php

namespace Collectify\Controller;
use Collectify\Model\ItemRepository;

class ItemController
{
	public function listAction()
	{
		return array();
	}

	public function addAction()
	{
		
	}
	
	public function editAction()
	{
		
	}

	/*
	 * Show infos
	 */
	public function showAction($id)
	{
		$repository = new ItemRepository();
		$item = $repository->load($id);
		$category = $item->category;
		return ['item' => $item, 'category' => $category];
	}
}