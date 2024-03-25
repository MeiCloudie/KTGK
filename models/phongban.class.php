<?php
require_once("./config/db.class.php");

class PhongBan
{
    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getAllPhongBan()
    {
        $queryString = "SELECT * FROM phongban";
        return $this->db->select_to_array($queryString);
    }
}
