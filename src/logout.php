<?php
session_start();
session_destroy();
// Corregido a fronted
header("Location: ../public/index.php");
exit();
