<?php

/**
 * Article
 *
 * A piece of writing for publication
 */
class Article{
    /**
     * Unique identifier
     * @var integer
     */
    public $id;
    /**
     * The article title
     * @var string
     */
    public $title;
    /**
     * The article content
     * @var string
     */
    public $content;
    /**
     * The publication and time
     * @var datetime
     */
    public $published_at;
    /**
     * Get all the articles
     * @param $db -connection to the database
     * @return array - an associative array for all the articles records
     */
    public $errors=[];
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
     * @return mixed An object containing the article with that ID, or null if not found
     */
    public static function getById($db, int $id, string $column = '*'): mixed
    {
        $sql = "SELECT $column 
            FROM articole
            WHERE id = :id";

        $stmt = $db->prepare($sql);
        // var_dump($stmt);

        $stmt->bindValue(':id',$id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Article');
        if ($stmt->execute()) {
            return $stmt->fetch();
        }

    }

    /**
     * Update the article with its current prop values
     *
     * @param object $db -connection to the database
     * @return boolean true if the update was succesful, false if not
     */
    public  function update($db): bool
    {
        if ($this->validate()) {

            $sql = "UPDATE articole 
                SET title = :title,
                    content = :content,
                    published_at = :published_at
                WHERE id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Validate the proprieties, putting any validation error messages in the $error prop
     *
     * @return bool True if the current prop are valid, false otherwhise
     */
    protected  function validate()
    {
        if ($this->title == '') {
            $this->errors[] = 'Title is required';
        }
        if ($this->content == '') {
            $this->errors[] = 'Content is required';
        }
//        if($this->published_at !='') {
//            $date_time = date_create_from_format('Y-m-d H:i:s',$this->published_at);
//
//            if($date_time === false) {
//                $this->errors[] = 'Invalid date and time';
//            } else {
//                $date_errors = date_get_last_errors();
//
//                if ($date_errors['warning_count'] > 0) {
//                    $this->errors[] = 'Invalid date and time';
//                }
//            }
//        }
        return empty($this->errors);
    }

    /**
     * Delete the current article
     *
     * @param $db -connection to the database
     * @return boolean True if delete was successful, false otherwise
     */
    public function delete($db){
        $sql = "DELETE FROM articole 
                WHERE id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Insert a new article with its current property values
     *
     * @param $db -connection to the database
     * @return boolean True if the insert was successful, false otherwise
     */
    public function create($db)
    {
        if ($this->validate()) {

            $sql = "INSERT INTO articole(title,content,published_at) 
                VALUES (:title, :content, :published_at)";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }
            if ($stmt->execute()){
                $this->id=$db->lastInsertId();
                return true;
            };
        } else {
            return false;
        }
    }


}