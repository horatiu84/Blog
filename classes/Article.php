<?php

/**
 * Article
 *
 * A piece of writing for publication
 */
class Article{
    /**
     * Get all the articles
     * @param $db -connection to the database
     * @return array - an associative array for all the articles records
     */
    public static function getAll($db): array
    {
        $sql = "SELECT *
                FROM articole
                ORDER BY published_at;";

        $results = $db->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the article record based on the ID
     *
     * @param $db -connection to the database
     * @param $id integer id of the article
     * @param $column -Optional list of columns for te select,default to '*'
     *
     * @return mixed An associative array containing the article with that ID, or null if not found
     */
    public static function getById($db, int $id, string $column = '*'): mixed
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
}