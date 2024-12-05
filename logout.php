<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 21/02/2019
 * Time: 03:39 PM
 */

session_start();
session_destroy();
header("Location: login.php");
