<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

function getEntityManager(){
//    $dotenv = Dotenv\Dotenv::createImmutable('config');
//    $dotenv->load();
    // Create a simple "default" Doctrine ORM configuration for Annotations
    $isDevMode = true;
    $proxyDir = null;
    $cache = null;
    $useSimpleAnnotationReader = false;
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/App/Models"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
    $config->addEntityNamespace('', 'App\Models');
    // or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
    $conn = array(
        'driver' => 'mysqli',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'php_cmc_webapp',
        'charset'=> 'UTF8'
    );

// obtaining the entity manager
    $entityManager = EntityManager::create($conn, $config);
    return $entityManager;
}
