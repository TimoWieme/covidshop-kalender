<?php
session_start();
session_destroy();

//Redirect after destroying session
header("Location: index.php");
exit;