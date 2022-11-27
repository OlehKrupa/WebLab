<?php
require_once "functions.php";

$users = OpenFile("users.php");
$findEmail ="krupao980@gmail.com";
$findPassword="123";

print_r(IsUser($findEmail,$findPassword,$users));
?>