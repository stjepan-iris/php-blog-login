<?php

class comments{
    private $dataBasHandler;
    private $order = "desc";
    private $comments;

    public function __construct ($dbh) {
        $this->dataBasHandler = $dbh;
    }

    public function fetch($id) {

        $query = "SELECT * FROM comments where postid=:postid ";
        $sth = $this->dataBasHandler->prepare($query);
        $sth->bindParam(':postid', $id);
        $return = $sth->execute();
        
        $row = $sth->fetchAll(PDO::FETCH_ASSOC);

        $this->comments = $row;
    }

    public function getComments() {
        return $this->comments;
    }
}
?>