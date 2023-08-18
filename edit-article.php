<?php

require "./includes/dbcon.php";
require "./includes/functions-article.php";

$db = dbConnect();

if (isset($_GET['id'])) {

    $article = getArticle($db, $_GET['id']);

    if ($article) {
        $id = $article['id'];
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {
        die("Article not found");
    }
} else {
    die("Id not supplied, article not found");
    $article = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = dbConnect();

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if ($published_at == '') {
        $published_at = null;
    }

    if (empty($errors)) {

        $sql = "UPDATE articole 
                SET title = ?,
                    content = ?,
                    published_at = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($db, $sql);

        if ($published_at == '') {
            $published_at = null;
        }



        mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);



        if (mysqli_stmt_execute($stmt)) {

            header("Location: article.php?id=$id");
            exit;
        } else {
            echo mysqli_stmt_error($stmt);
        }
    }
}


?>
<h2>Edit article</h2>
<?php require './includes/article-form.php'; ?>

<?php require './includes/footer.php' ?>