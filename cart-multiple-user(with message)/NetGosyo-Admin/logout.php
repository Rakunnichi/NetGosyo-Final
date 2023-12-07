<?php

session_start();
unset($user_name);
unset($_SESSION);
session_destroy();

header("Location:../Netgosyo-Admin/login.php");
exit;
