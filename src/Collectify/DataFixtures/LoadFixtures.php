<?php

require_once __DIR__ . '/../../../core/bootstrap.php';

$className = ucfirst($argv[1]);

$classFixtures = sprintf('\\Collectify\\DataFixtures\\%sFixtures', $className);
$objectFixtures = new $classFixtures();
$objectFixtures->loadFixtures();
