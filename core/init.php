<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

spl_autoload_register(function($class) {

    require_once '../classes/' . $class . '.php';
});

