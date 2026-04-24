<?php
session_start();
session_destroy();
// Corregido a fronted
header("Location: ../fronted/index.php");
exit();
