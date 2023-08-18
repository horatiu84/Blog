<?php

require "./includes/dbcon.php";
require "./includes/functions-article.php";

$db = dbConnect();

if (isset($_GET['id'])) {



    //     $sql = "SELECT *
    //             FROM articole
    //             WHERE id=".$_GET['id'];

    //     $results = mysqli_query($db,$sql);

    //     $article = mysqli_fetch_assoc($results);
    // } else {
    //     $article = null;
    // } 
    //we replace all this with a function

    $article = getArticle($db, $_GET['id']);
} else {
    $article = null;
}
?>


<h2>Article : </h2>
<?php if (empty($article)) : ?>
    <p>No articles in the database</p>
<?php else : ?>
    <ul>
        <li>
            <article>
                <h3> <?= htmlspecialchars($article['title'])  ?></h3>
                <p><?= htmlspecialchars($article['content'])  ?></p>
            </article>
        </li>
    </ul>
    <a href="edit-article.php?id=<?= $article['id'] ?>">Edit</a>
    <a href="delete-article.php?id=<?= $article['id'] ?>">Delete</a>
<?php endif ?>