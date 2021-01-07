<?php
include_once 'DbConnect.php';
$db = new DbConnect();
$conn = $db->OpenCon();
echo "Connected Successfully";
$db->CloseCon($conn);
?>