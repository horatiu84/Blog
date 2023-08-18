<?php
require './includes/dbcon.php';
require './includes/functions-article.php';

$errors = [];
$title = '';
$content = '';
$published_at = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = dbConnect();

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

   $errors = validateArticle($title,$content,$published_at);
    
   
   if (empty($errors)) {
       
       if ($published_at == '') {
           $published_at = null;
       }


        // FIRST METHOD TO AVOID SQL INJECTIONS
        // $sql = "INSERT INTO articole (title,content,published_at)
        //         VALUES ('" . mysqli_real_escape_string($db,$_POST['title'])  . "','"
        //                    . mysqli_real_escape_string($db,$_POST['content']) . "','"
        //                    . mysqli_real_escape_string($db,$_POST['published_at']) . "')";



        // var_dump($sql);
        // $results = mysqli_query($db, $sql);

        // if ($results ===  false) {
        //     echo mysqli_error($db);
        // } else {

        //     $id = mysqli_insert_id($db);
        //     echo "Inserted record with ID: $id";
        // }

        // SECOND METHOD TO AVOID SQL INJECTIONS
        //1.Write sql that contains placeholders for values
        $sql = "INSERT INTO articole (title,content,published_at)
            VALUES (?,?,?)";
        // 2. prepare the statement
        $stmt = mysqli_prepare($db, $sql);
        // 3.Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

        // 4. we execute the statement, if return true is success

        if (mysqli_stmt_execute($stmt)) {
            $id = mysqli_insert_id($db);
            header("Location: article.php?id=$id");
            exit;
        } else {
            echo mysqli_stmt_error($stmt);
        }
    }
}

?>
<?php require './includes/header.php' ?>

<h2>New article</h2>

<?php require './includes/article-form.php'; ?>

<?php require './includes/footer.php' ?>