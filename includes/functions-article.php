<?php
/**
 * Get the article record based on the ID
 *
 * @param $db -connection to the database
 * @param $id integer id of the article
 * @param $column -Optional list of colums for te select,default to '*'
 *
 * @return mixed An associative array containing the article with that ID, or null if not found
 */
function getArticle($db, $id, $column = '*')
{
    $sql = "SELECT $column 
            FROM articole
            WHERE id = :id";

    $stmt = $db->prepare($sql);
    // var_dump($stmt);

        $stmt->bindValue(':id',$id, PDO::PARAM_INT);
        if ($stmt->execute()) {
           return $stmt->fetch(PDO::FETCH_ASSOC);
        }

}


function validateArticle($title,$content): array
{
   $errors = [];

    if ($title == '') {
        $errors[] = 'Title is required';
    }

    if ($content == '') {
        $errors[] = 'Content is required';
    }
    
   
    return $errors;
    
}
