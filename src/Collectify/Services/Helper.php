<?php

namespace Collectify\Services;

class Helper
{
	public function getList($type)
	{
		$repositoryClass = sprintf('Collectify\\Model\\%sRepository', $type);
		$repository = new $repositoryClass();

		$objects = $repository->getAll();
		$html = '';

		foreach($objects as $object){
			$name = $object->name;
			$showLink = sprintf('<a href="app.php?controller=%s&action=show&id=%s" class="btn btn-info"><i class="fa fa-eye"></i></a>', $repository->getType(), $object->id);
			$editLink = sprintf('<a href="app.php?controller=%s&action=edit&id=%s" class="btn btn-primary"><i class="fa fa-pencil"></i></a>', $repository->getType(), $object->id);
			$removeLink = sprintf('<a href="app.php?controller=%s&action=remove&id=%s" class="btn btn-danger"><i class="fa fa-trash"></i></a>', $repository->getType(), $object->id);
			$html .= <<<EOF
<tr>
	<td>$name</td>
	<td>$showLink $editLink $removeLink</td>
</tr>
EOF;
		}

	return $html;
	}
}