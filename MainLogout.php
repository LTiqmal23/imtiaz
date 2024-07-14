<?php
session_start();
$_SESSION = array();
session_destroy();
echo "<script>
    alert('You have been successfully logged out.');
    location.href='MainLogin.html';
</script>";
exit();