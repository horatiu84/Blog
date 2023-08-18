<?php

require "./includes/dbcon.php";
require "./includes/functions-article.php";

$db = dbConnect();

if (isset($_GET['id'])) {

    $article = getArticle($db, $_GET['id'],"id");

    if ($article) {
        $id = $article['id'];
    } else {
        die("Article not found");
    }
} else {
    die("Id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM articole 
            WHERE id = ?";

    $stmt = mysqli_prepare($db, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);


    if (mysqli_stmt_execute($stmt)) {

        header("Location: blog.php");
        exit;
    } else {
        echo mysqli_stmt_error($stmt);
    }
}

?>

<?php require './includes/header.php' ?>

<h2>Delete article</h2>
<form method="post" >
    <p>Are you sure?</p>
    <button>Delete</button>
    <a href="article.php?id=<?= $article['id'] ?>">Cancel</a>
</form>
<?php require_once './includes/footer.php'; ?>