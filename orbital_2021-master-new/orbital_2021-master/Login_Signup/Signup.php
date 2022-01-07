<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleSignupLogin.css">
        <style>
            <?php include '../Header/styleHeader.css'; ?>
        </style>

    <body class = "full grey bg_img">
    <?php include_once '../Header/Header.php'; ?>

    <div class="form">
        <div class="main_h_img">
            <img src="./img/user.png">
        </div>
        <h1 class="title fontsset1">Sign Up</h1>
        <p class = "member fontsset1"> Already a member? <a href = 'Login.php'>Log in</a></p>
        <form action="includes/signup.inc.php" method="post">

            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Name">
                <input class="form-control" type="text" name="email" placeholder="Email">
                <input class="form-control" type="text" name="uid" placeholder="Username">
                <input class="form-control" type="password" name="pwd" placeholder="Password">
                <input class="form-control" type="password" name="pwdrepeat" placeholder="Repeat Password">
                <button class="btn btn-primary btn_cu" type="submit" name="submit">Sign up</button>
            </div>

        </form>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p class = 'error-message fontsset1'>Not all fields were filled in!</p>";
        } else if ($_GET["error"] == "invaliduid") {
            echo "<p class = 'error-message fontsset1'>Invalid username!</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p class = 'error-message fontsset1'>Invalid email!</p>";
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p class = 'error-message fontsset1'>Passwords don't match!</p>";
        } else if ($_GET["error"] == "stmtfailed") {
            echo "<p class = 'error-message fontsset1'>Something went wrong :-( Try again!</p>";
        } else if ($_GET["error"] == "usernametaken") {
            echo "<p class = 'error-message fontsset1'>Username/email already taken!</p>";
        } else if ($_GET["error"] == "none") {
            echo "<p class = 'error-message fontsset1'>You have signed up!</p>";
        }
    }
    ?>
    </div>
    </body>
</html>