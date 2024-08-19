<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}

if (isset($_POST['submit'])) {
    include('connect.php');
    $productname = $_POST['productname'];
    $productdescription = $_POST['productdescription'];
    $productcategory = $_POST['productcategory'];
    $productprice = $_POST['productprice'];
    $time = date("j,F,Y");
    $username = $_SESSION['Username'];
    $product_b_name = $_POST['productbrandname'];
    $product_add = $_POST['productaddress'];
    $city=$_POST['city'];
    $state=$_POST['state'];

    // Insert product details into the products table
    $sql2 = "INSERT INTO products (product_name, cat_id, price, product_description, product_add, product_br_name, p_time, username,city,state)
            VALUES ('$productname', '$productcategory', '$productprice', '$productdescription', '$product_add', '$product_b_name', '$time', '$username','$city','$state')";
    $res = mysqli_query($con, $sql2);
    $product_id = mysqli_insert_id($con); // Get the last inserted product ID

    if ($res && isset($_FILES['productimages']) && !empty($_FILES['productimages']['name'][0])) {
        $total_files = count($_FILES['productimages']['name']);

        for ($i = 0; $i < $total_files; $i++) {
            $name = $_FILES['productimages']['name'][$i];
            $size = $_FILES['productimages']['size'][$i];
            $type = $_FILES['productimages']['type'][$i];
            $tmp_name = $_FILES['productimages']['tmp_name'][$i];

            $max_size = 10000000;
            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            if (($extension == "jpg" || $extension == "jpeg" || $extension == "png") && $size <= $max_size) {
                $location = "uploads/";

                if (move_uploaded_file($tmp_name, $location . $name)) {
                    // Save image path to the images table
                    $imageLocation = $location . $name;
                    $img_sql = "INSERT INTO images (product_id, image_url) VALUES ('$product_id', '$imageLocation')";
                    mysqli_query($con, $img_sql);
                } else {
                    $message = "Failed to upload some files";
                }
            } else {
                $message = "Only JPG/PNG files are allowed and should be less than 10MB";
            }
        }
    }

    if ($res) {
        $message = 'Saved Successfully with image';
    } else {
        $message = "Failed to Create Product";
        echo "Error: " . $sql2 . "<br>" . mysqli_error($con);
    }

    header('location:index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>adspost</title>
  <?php include("style.php"); ?>
  <?php include("boot-css.php"); ?>
</head>
<body style="background: #F4F5F7; h-100">

<div class="container mt-3">
    <div class="card">
        <div class="card-header fw-bold fs-5" style="background: #4bbfdb; color:#fff;">
            Add Products
        </div>
        <div class="card-body">
            <section id="content">
                <div class="content-blog bg-white py-3">
                    <div class="container">
                        <?php
                        if (isset($message)) {
                            echo '<div class="alert alert-success">' . $message . '</div>';
                        }
                        ?>
                        <form method="post" enctype="multipart/form-data" action='adspost.php'>
                            <div class="form-group">
                                <label for="Productname">Product Name</label>
                                <input type="text" class="form-control" name="productname" id="Productname" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                                <label for="productdescription">Product Description</label>
                                <textarea class="form-control" name="productdescription" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="productcategory">Product Category</label>
                                <select class="form-control" id="productcategory" name="productcategory">
                                    <option value="" selected>---SELECT CATEGORY---</option>
                                    <?php
                                    include('connect.php');
                                    $sql3 = "SELECT * FROM category";
                                    $result3 = mysqli_query($con, $sql3);
                                    while ($row1 = mysqli_fetch_array($result3)) {
                                        echo '<option value="' . $row1['cat_id'] . '">' . $row1['cat_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productprice">Product Price</label>
                                <input type="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price">
                            </div>
                            <div class="form-group">
                                <label for="productaddress">Local Address</label>
                                <input type="text" name="productaddress" class="form-control" placeholder="Enter address" required>
                            </div>
                            <div class="form-group">
                                <label for="productaddress">City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter address" required>
                            </div>
                            <div class="form-group">
                                <label for="productaddress">State</label>
                                <input type="text" name="state" class="form-control" placeholder="Enter state" required>
                            </div>
                            <div class="form-group">
                                <label for="productbrandname">Product Brand Name</label>
                                <input type="text" name="productbrandname" class="form-control" placeholder="Enter Brand name" required>
                            </div>
                            <div class="form-group">
                                <label for="productimages">Product Images</label>
                                <input type="file" name="productimages[]" id="productimages" multiple>
                                <p class="help-block">Only jpg/png are allowed.</p>
                            </div>
                            <button type="submit" name="submit" id="b1-color" class="btn mx-2">Submit</button>
                            <button class="btn btn-danger mx-2"><a href="index.php" style="text-decoration:none; color:#fff;">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include("boot-script.php"); ?>
</body>
</html>
