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
        <h1 class="title fontsset1">Log In</h1>
        <p class = "member fontsset1"> Not a member? <a href = 'Signup.php'>Sign up</a></p>
        <form action="includes/login.inc.php" method="post">
            <div class="form-group">
                <input class="form-control" type="text" name="uid" placeholder="Username/Email">
                <input class="form-control" type="password" name="pwd" placeholder="Password">
                <button class="btn btn-primary btn_cu" type="submit" name="submit">Log In</button>
            </div>
        </form>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p class = 'error-message fontsset1'>Not all fields were filled in!</p>";
        } else if ($_GET["error"] == "wronglogin") {
            echo "<p class = 'error-message fontsset1'>Username or password is incorrect!</p>";
        }
    }
    ?>
    </div>
    </body>
</html>