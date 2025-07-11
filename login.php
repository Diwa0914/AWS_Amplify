<?php
session_start();
include('connect.php');

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

$check = mysqli_query($con, "SELECT * FROM user WHERE Phone='$mobile' AND Password='$password' AND Role='$role'");

if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_array($check);

    // Store party/group info into session from user table (role 2 = group)
    $groups = mysqli_query($con, "SELECT ID, Name, Voters, Photo FROM user WHERE Role=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
        <script>
        window.location = "../routes/dashboard.php";
        </script>
    ';
} else {
    echo '
        <script>
        alert("Invalid credentials!");
        window.location = "../index.html";
        </script>
    ';
}
?>
