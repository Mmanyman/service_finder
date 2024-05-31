<?php
session_start();
session_unset();
session_destroy();
echo "<script> alert('Logout successful!') </script>";
header("Location:index.php");
exit();
?>