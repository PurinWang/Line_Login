<?php 
require __DIR__ . '/../vendor/autoload.php';
use Purin\LineLogin\ConfigManager;
use Purin\LineLogin\OAuthController;
use Purin\LineLogin\LineProfileController;

$config = new ConfigManager();
$auth = new OAuthController($config);
$profile = new LineProfileController($config);
$token = $auth->getAccessToken($_GET['code']);

// $token = $auth->getDecodeIdData($_GET['code'],true);
// print_r($token);

$info = $profile->getUserprofile($token);
print_r($info);