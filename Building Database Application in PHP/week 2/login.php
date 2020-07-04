<?php
    require_once "connection.php";

    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return;
    }

    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

    $failure = false;  // If we have no POST data

    if ( isset($_POST['who']) && isset($_POST['pass'])  ) {
        if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
            $failure = "Username and password are required";
        }   
        else if (strpos($_POST['who'], "@") === false) {
            $failure = "Username must have an at-sign (@)";
        }
        else{
            $check = hash('md5', $salt . $_POST['pass']);
            if ($check == $stored_hash) {
                error_log("Login success ".$_POST['who']);
                header("Location: auto.php?name=".urlencode($_POST['who']));
                return;
            }
            else {
            $failure = "Incorrect password";
            error_log("Login fail ".$_POST['who']." $check");
            }
        }
    }        
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Tanishq Varshney's(32b3a77e) Login Page</title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    if ($failure !== false) {
        echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
    }
    ?>
    <form method="POST">
        <label for="name">Username</label>
        <input type="text" name="who" id="name"><br/>
        <label for="id_1723">Password</label>
        <input type="text" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    <p>
        For a pass hint, view source and find a pass hint
        in the HTML comments.
        <!-- Hint: The pass is the three character programming language you are currently using makes (all lower case) followed by 123. -->
    </p>
</div>
</body>