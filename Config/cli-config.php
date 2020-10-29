<?php
namespace Config;
/**
 * @var $entityManager
 */
require_once __DIR__."/../bootstrap.php";
$entityManager = getEntityManager();
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
//vendor\bin\doctrine.bat orm:schema-tool:create
//vendor\bin\doctrine.bat orm:schema-tool:drop --force
//vendor\bin\doctrine.bat orm:schema-tool:update --force --dump-sql