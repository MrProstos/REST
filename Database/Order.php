<?php

use JetBrains\PhpStorm\ArrayShape;

include "ConnDB.php";
include "Database.php";

class Order extends ConnDB implements Database
{

    private string $phone_num;
    private string $to;
    private string $body;
    private int $status;

    public function Set(string $phone_num = "", string $to = "", string $body = "", int $status = 0)
    {
        $this->phone_num = $phone_num;
        $this->to = $to;
        $this->body = $body;
        $this->status = $status;
    }

    #[ArrayShape(["phone_num" => "string", "to" => "string", "body" => "string", "status" => "string"])]
    public function Get(): array
    {
        return array(
            "phone_num" => $this->phone_num,
            "to" => $this->to,
            "body" => $this->body,
            "status" => $this->status,
        );
    }


    public function Select(): array|string
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

    public function Insert():bool
    {
        try {
            $data = array($this->phone_num, $this->to, $this->body, $this->status);
            $exec = $this->getDBH()->prepare("INSERT INTO orders (phone_num, send, body, status) VALUES (?,?,?,?)");
            return $exec->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Update()
    {
        // TODO: Implement Update() method.
    }

    public function Delete()
    {
        // TODO: Implement Delete() method.
    }
}