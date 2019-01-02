<?php

namespace Collectify\DataFixtures;

use Collectify\Model\UserRepository;

class UserFixtures extends BaseFixtures
{
	public function getType()
	{
		return UserRepository::TYPE;
	}
	
	public function getFixtures()
	{
		return array(
			array(
				'firstname' => 'John',
				'lastname' => 'Loock',
				'username' => 'john@test.com',
				'password' => 'password'
			)
		);
	}
}
