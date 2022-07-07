<?php

use JetBrains\PhpStorm\ArrayShape;

include "ConnDB.php";
include "Database.php";

class Client extends ConnDB implements Database
{
    private string $phone_num;
    private string $firstname;
    private string $lastname;
    private string $birthday;

    public function Set(string $phone_num = "", string $firstname = "", string $lastname = "", string $birthday = "")
    {
        $this->phone_num = $phone_num;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthday = $birthday;
    }


    #[ArrayShape(["phone_num" => "string", "firstname" => "string", "lastname" => "string", "birthday" => "string"])]
    public function Get(): array
    {
        return array(
            "phone_num" => $this->phone_num,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "birthday" => $this->birthday,
        );
    }

    public function Select(): array|bool
    {
        try {
            $arr = [];
            $query = $this->getDBH()->prepare("SELECT * FROM clients WHERE phone_num = ?");
            $query->execute(array($this->phone_num));
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $arr = $row;
            }
            return $arr;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function Insert(): bool
    {
        try {
            $data = array($this->phone_num, $this->firstname, $this->lastname, $this->birthday);
            $exec = $this->getDBH()->prepare("INSERT INTO clients (phone_num, firstname, lastname, birthday) VALUES (?,?,?,?)");
            return $exec->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Update():bool
    {
        try {
            $data = array($this->firstname, $this->lastname, $this->birthday,$this->phone_num);
            $exec = $this->getDBH()->prepare("UPDATE clients SET firstname=?, lastname=?, birthday=? WHERE phone_num=?");
            return $exec->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Delete(): bool|int
    {
        try {
            $data = array($this->phone_num);
            $exec = $this->getDBH()->prepare("DELETE FROM clients WHERE phone_num=?");
            $exec->execute($data);
            return $exec->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}