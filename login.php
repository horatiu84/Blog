<?php

include_once './includes/autoloader.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new Database();
    $db = $conn->getConn();

    if (User::authenticate($db,$_POST['username'],$_POST['password'])) {

        Auth::login();
        header("Location: blog.php");
    } else {
        $error = 'login incorrect';
    }
}

?>

<?php require './includes/header.php'; ?>

<h2>Login</h2>

<form method="post">
    <div>
        <label for="username">Username</label>
        <input name="username" id="username">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <button>Log in</button>
</form>

<?php require 'includes/footer.php' ?>