<?php

namespace Collectify\DataFixtures;

abstract class BaseFixtures
{
	public function loadFixtures()
	{
		$type = $this->getType();
		$fixtures = $this->getFixtures();

		foreach($fixtures as $data) {
			$repositoryClass = sprintf('\\Collectify\\Model\\%sRepository', ucfirst($type));
			$repository = new $repositoryClass();
			$repository->create($data);
		}

	}
}
