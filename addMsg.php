<?php
session_start();
include('connect.php');

$sender = isset($_GET['sender']) ? $_GET['sender'] : '';
$receiver = isset($_GET['receiver']) ? $_GET['receiver'] : '';
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
$msg = isset($_GET['msg']) ? mysqli_real_escape_string($con, $_GET['msg']) : '';

if ($sender && $receiver && $product_id && $msg) {
    $timestamp = date('Y-m-d H:i:s');
    $q = "INSERT INTO `msg` (sender, receiver, product_id, msg, timestamp) VALUES ('$sender', '$receiver', '$product_id', '$msg', '$timestamp')";
    mysqli_query($con, $q);
}
?>
