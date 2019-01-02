<?php

namespace Collectify\Model;

use RedBeanPHP\Facade as R;

abstract class BaseRepository
{
	abstract function getType();

	public function create($data)
	{
		$object = R::dispense($this->getType());
		$this->setData($data, $object);
		
		$this->save($object);
	}

	public function update($data, $object)
	{
		$this->setData($data, $object);
		
		$this->save($object);
	}

	private function save($object)
	{
		R::store($object);
	}

	private function setData($data, $object)
	{
		foreach($data as $property => $value) {
			$object->$property = $value;
		}

		return $object;
	}

	public function load($id)
	{
		return R::load($this->getType(), $id);
	}

	public function getAll()
	{
		return R::findAll($this->getType());
	}

	public function remove($id)
	{
		return R::trash($this->load($id));
	}
}
