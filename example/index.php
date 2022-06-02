<?php 
require __DIR__ . '/../vendor/autoload.php';
use Purin\LineLogin\ConfigManager;
use Purin\LineLogin\LineAuthorization;
use Dotenv\dotenv;

if(isset($_POST['login'])){
    $config = new ConfigManager();
    $lineauth = new LineAuthorization($config);
    $url = $lineauth->createAuthUrl();
    header("Location:".$url);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <input type="submit" name="login" value="登入">
    </form>
</body>
</html>