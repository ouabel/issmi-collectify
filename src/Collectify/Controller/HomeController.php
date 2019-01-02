<?php

namespace Collectify\Controller;

use RedBeanPHP\Facade as R;
use Collectify\Model\ItemRepository;

class HomeController
{
	public function homepageAction()
	{
		$item = R::load(ItemRepository::TYPE, 1);
		return array('item' => $item);
	}
}