
<?php 
require_once 'functions/helper.php';

logOut();

$url = 'http://' . $_SERVER['HTTP_HOST'];

header('Location:'.$url);


