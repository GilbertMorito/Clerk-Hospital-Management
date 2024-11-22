<?php
	if (file_exists('../includes/database.php')) {include_once('../includes/database.php');}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login & Registration Form</title>
    <link rel="stylesheet" href="../css/logincss.css">
</head>
<body>
<div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
        <header>Login</header>
        <form action="" method="post">
            <input type="text" name="acc" placeholder="Enter your email" required>
            <input type="password" name="pass" placeholder="Enter your password" required>
            <a href="javascript:void(0);">Forgot password?</a>
            <button type="submit" class="button">Login</button>
        </form>
        <div class="signup">
            <span class="signup">Don't have an account?
             <label for="check">Signup</label>
            </span>
        </div>
    </div>

    <div class="registration form">
        <header>Signup</header>
        <form action="" method="post">
            <input type="text" name="new_acc" placeholder="Enter your email" required>
            <input type="password" name="new_pass" placeholder="Create a password" required>
            <input type="password" name="confirm_pass" placeholder="Confirm your password" required>
            <button type="submit" class="button">Sign Up</button>
        </form>
        <div class="signup">
            <span class="signup">Already have an account?
             <label for="check">Login</label>
            </span>
        </div>
    </div>
</div>
<script src="../js/sweetalert.min.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acc']) && isset($_POST['pass'])) {
    $account = mysqli_real_escape_string($con, $_POST['acc']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);

    $result = mysqli_query($con, "SELECT * FROM tbllogin WHERE account='$account' AND password='$password' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        echo "<script>location.href='../index.php';</script>";
    } else {
        echo "<script>
                swal('Login', 'Incorrect Email or Password.', 'error');
              </script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_acc']) && isset($_POST['new_pass']) && isset($_POST['confirm_pass'])) {
    $newAccount = mysqli_real_escape_string($con, $_POST['new_acc']);
    $newPassword = mysqli_real_escape_string($con, $_POST['new_pass']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm_pass']);

    if ($newPassword === $confirmPassword) {
        // Check if account already exists
        $checkQuery = mysqli_query($con, "SELECT * FROM tbllogin WHERE account='$newAccount'");
        if (mysqli_num_rows($checkQuery) > 0) {
            echo "<script>
                    swal('Sign Up', 'Account already exists. Please try a different email.', 'error');
                  </script>";
        } else {
            $insertQuery = "INSERT INTO tbllogin (account, password) VALUES ('$newAccount', '$newPassword')";
            if (mysqli_query($con, $insertQuery)) {
                echo "<script>location.href='../index.php';</script>";
            } else {
					echo "<script>
							swal('Sign Up', 'Error creating account. Please try again later.', 'error');
                      </script>";
            }
        }
    } else {
        echo "<script>
                swal('Sign Up', 'Passwords do not match. Please try again.', 'error');
              </script>";
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acc']) && isset($_POST['pass'])) {
    $account = mysqli_real_escape_string($con, $_POST['acc']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);

    // Get the login details from the database
    $result = mysqli_query($con, "SELECT * FROM tbllogin WHERE account='$account' AND password='$password' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        // Success login, redirect to home page
        echo "<script>location.href='../index.php';</script>";
    } else {
        // Invalid login, show error message
        echo "<script>swal('Login', 'Incorrect Email or Password.', 'error');</script>";
    }
}

// Signup Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_acc']) && isset($_POST['new_pass']) && isset($_POST['confirm_pass'])) {
    $newAccount = mysqli_real_escape_string($con, $_POST['new_acc']);
    $newPassword = mysqli_real_escape_string($con, $_POST['new_pass']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm_pass']);

    if ($newPassword === $confirmPassword) {
        // Check if account already exists
        $checkQuery = mysqli_query($con, "SELECT * FROM tbllogin WHERE account='$newAccount'");
        if (mysqli_num_rows($checkQuery) > 0) {
        } else {
            // Insert new account into database
            $insertQuery = "INSERT INTO tbllogin (account, password) VALUES ('$newAccount', '$newPassword')";
            if (mysqli_query($con, $insertQuery)) {
                echo "<script>location.href='../index.php';</script>";
            } else {
                swal('Sign Up', 'Error creating account. Please try again later.', 'error');
            }
        }
    } else {  
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
		swal('Sign Up', 'Password does not match.', 'error');
    }
}
?>


</body>
</html>
