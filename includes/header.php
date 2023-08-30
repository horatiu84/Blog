<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My blog</title>
</head>
<body>
<?php const ROOT = "/mysite/Udemy/Blog"; ?>
    <header>
        <h1>My blog</h1>
    </header>

    <nav>
        <ul>
            <?php if (Auth::isLoggedIn()) : ?>
                <li><a href="<?= ROOT?>/blog.php">Home</a></li>
                <li><a href="<?= ROOT?>/admin/blog.php">Admin</a></li>
                <li><a href="<?= ROOT?>/logout.php">Log out</a></li>
            <?php else : ?>
                <li><a href="<?= ROOT?>/login.php">Log in</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <main>

