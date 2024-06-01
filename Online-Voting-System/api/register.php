<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image_name = $_FILES['photo']['name'];
$image_tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

$target_dir = "../uploads/"; 
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); 
    echo "klasör yoktu olustu";
}else{
    echo "klasör zaten vardı";
}

if ($password == $cpassword) {
    if(move_uploaded_file($image_tmp_name, $target_dir . $image_name)) {
        $insert = mysqli_query($conn, "INSERT INTO user (name, mobile, password, address, photo, role, status, votes) VALUES ('$name', '$mobile', '$password', '$address', '$image_name', '$role', 0, 0)");
        if ($insert) {
            echo '
            <script> 
                 alert("Registration Successful");
                 window.location = "../";
            </script>
        ';
        } else {
            echo '
            <script> 
                alert("Some error occurred");
                window.location = "../routes/register.html";
            </script>
       ';
        }
    } else {
        echo '
        <script> 
            alert("Failed to move uploaded file");
            window.location = "../routes/register.html";
        </script>
        ';
    }
} else {
    echo '
       <script>
           alert("Password and Confirm password do not match");
           window.location = "../routes/register.html";
       </script>
    ';
}
mysqli_close($conn);
?>


