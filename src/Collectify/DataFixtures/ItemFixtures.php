<?php

namespace Collectify\DataFixtures;

use Collectify\Model\ItemRepository;

class ItemFixtures extends BaseFixtures
{
	public function getType()
	{
		return ItemRepository::TYPE;
	}
	
	public function getFixtures()
	{
		return array(
			array(
				'title' => 'The Chronic',
				'author' => 'Dr Dre',
				'releasedAt' => null,
				'gender' => 'RAP',
				'support' => 'CD',
				'category_id' => 1,
				'user_id' => 1,
			)
		);
	}
}
