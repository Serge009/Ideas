<?php
// load the (optional) Composer auto-loader
require "vendor/autoload.php";

$paths = array("application/entity");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'ideas',
);

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
//$entityManager = EntityManager::create($dbParams, $config);

// start the application
$app = new Application();
