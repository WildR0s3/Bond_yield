<?php
include 'autoloader.php';
echo print_r($_POST);
(new Bonds)->insertBond();
header("location: ../index.php");

