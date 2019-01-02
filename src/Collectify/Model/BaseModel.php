<?php

namespace Collectify\Model;
use Nibble\NibbleForms\Useful;

abstract class BaseModel extends \RedBeanPHP\SimpleModel
{
	public $slug;
	public $createdAt;
	public $updatedAt;
	public $now;
	public $unboxObject;

	public function update()
	{
		$this->now = new \DateTime(null, new \DateTimeZone('Europe/Paris'));

		$this->unboxObject = $this->unbox();

		$this->setSlug();
		$this->setCreatedAt();
		$this->setUpdatedAt();
	}

	private function setSlug()
	{
		$text = $this->unboxObject->name ? : $this->unboxObject->title;
		if(!$text){
			return;
		}
		$slug = Useful::slugify($text);
		$this->unboxObject->slug = $slug;
	}

	private function setCreatedAt()
	{
		if(!$this->unboxObject->createdAt){
			$this->unboxObject->createdAt = $this->now;
		}
	}

	private function setUpdatedAt()
	{
		$this->unboxObject->updatedAt = $this->now;
	}
}
