<?php
session_start();
include('connect.php');

if (!isset($_SESSION['Username'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

if (!isset($_POST['product_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Product ID not provided']);
    exit;
}

$username = $_SESSION['Username'];
$productID = $_POST['product_id'];

$sql = "SELECT id FROM accountinfo WHERE username = '$username'";
$result = mysqli_query($con, $sql);

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch user ID: ' . mysqli_error($con)]);
    exit;
}

$user = mysqli_fetch_assoc($result);
if (!$user) {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
    exit;
}

$userID = $user['id'];

// Check if the product is already in the wishlist
$check_sql = "SELECT * FROM wishlist WHERE user_id = '$userID' AND product_id = '$productID'";
$check_result = mysqli_query($con, $check_sql);

if (!$check_result) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to check wishlist: ' . mysqli_error($con)]);
    exit;
}

if (mysqli_num_rows($check_result) > 0) {
    // Remove from wishlist
    $remove_sql = "DELETE FROM wishlist WHERE user_id = '$userID' AND product_id = '$productID'";
    if (mysqli_query($con, $remove_sql)) {
        echo json_encode(['status' => 'removed']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to remove from wishlist: ' . mysqli_error($con)]);
    }
} else {
    // Add to wishlist
    $add_sql = "INSERT INTO wishlist (user_id, product_id) VALUES ('$userID', '$productID')";
    if (mysqli_query($con, $add_sql)) {
        echo json_encode(['status' => 'added']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add to wishlist: ' . mysqli_error($con)]);
    }
}
?>
