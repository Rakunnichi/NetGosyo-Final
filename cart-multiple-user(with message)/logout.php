<?php

session_start();
unset($user_id);
unset($_SESSION);
session_destroy();

header("Location: index.php");
exit;
