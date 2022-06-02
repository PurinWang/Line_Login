<?php 
require __DIR__ . '/../vendor/autoload.php';
use Purin\LineLogin\ConfigManager;
use Purin\LineLogin\OAuthController;
use Purin\LineLogin\LineProfileController;

$config = new ConfigManager();
$auth = new OAuthController($config);
$profile = new LineProfileController($config);
$token = $auth->getAccessToken($_GET['code']);
$info = $profile->getUserprofile($token);
// print $token;
// print $auth->VerifyAccessToken($token) ? 'true': 'false';
print_r($info);