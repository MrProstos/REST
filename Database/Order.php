<?php

include "ConnDB.php";
include "Database.php";

class Order extends ConnDB implements Database
{

    private string $phone_num;
    private string $to;
    private string $body;
    private int $status;

    function __construct(string $phone_num = "", string $to = "", string $body = "", int $status = 1)
    {
        parent::__construct();

        $this->phone_num = $phone_num;
        $this->to = $to;
        $this->body = $body;
        $this->status = $status;
    }


    public function Select(): bool|array
    {
        try {
            $arr = [];
            $query = $this->getDBH()->prepare("SELECT * FROM orders WHERE phone_num = ?");
            $query->execute(array($this->phone_num));
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $arr[] = $row;
            }
            return $arr;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Insert(): bool|int
    {
        try {
            $data = array($this->phone_num, $this->to, $this->body, $this->status);
            $exec = $this->getDBH()->prepare("INSERT INTO orders (phone_num, send, body, status) VALUES (?,?,?,?)");
            $exec->execute($data);
            return $exec->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Update(): bool|int
    {
        try {
            $data = array($this->phone_num, $this->to, $this->body, $this->status);
            $exec = $this->getDBH()->prepare("UPDATE orders SET send=?, body=?, status=? WHERE phone_num=?");
            $exec->execute($data);
            return $exec->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Delete(): bool|int
    {
        try {
            $data = array($this->phone_num);
            $exec = $this->getDBH()->prepare("DELETE FROM orders WHERE phone_num=?");
            $exec->execute($data);
            return $exec->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}