<?php
require_once('./config/db.class.php');

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getUserByUsername($username)
    {
        $statement = $this->db->connect()->prepare("SELECT * FROM user WHERE username = ?");
        $statement->bind_param("s", $username); // ràng buộc là kiểu string
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }
}
