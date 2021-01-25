<?php

class Product
{
    private $conn;
    private $table_name = "kontrahenci";

    public $ID_kontrahenta;
    public $Nazwa;
    public $NIP;
    public $Bank;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function read()
    {
        $query = "SELECT ID_kontrahenta, Nazwa, NIP, Bank FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    //public function json()
    //{
    //    $query = "SELECT kontrahenci.ID_kontrahenta, kontrahenci.Nazwa, kontrahenci.NIP, CONCAT(siedziby.Miasto,', ',siedziby.Ulica,' ',siedziby.Numer_domu) as Adres, siedziby.Mail, siedziby.Telefon
    //    FROM kontrahenci INNER JOIN siedziby ON kontrahenci.ID_kontrahenta=siedziby.ID_kontrahenta";
   //     $stmt = $this->conn->prepare($query);
   //     $stmt->execute();
   //     return $stmt;
   // }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Nazwa=:Nazwa, NIP=:NIP, Bank=:Bank";
        $stmt = $this->conn->prepare($query);

        $this->Nazwa = htmlspecialchars(strip_tags($this->Nazwa));
        $this->NIP = htmlspecialchars(strip_tags($this->NIP));
        $this->Bank = htmlspecialchars(strip_tags($this->Bank));

        $stmt->bindParam(":Nazwa", $this->Nazwa);
        $stmt->bindParam(":NIP", $this->NIP);
        $stmt->bindParam(":Bank", $this->Bank);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readOne()
    {
        $query = "SELECT ID_kontrahenta, Nazwa, NIP, Bank FROM " . $this->table_name . " WHERE NIP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NIP);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->ID_kontrahenta = $row['ID_kontrahenta'];
        $this->Nazwa = $row['Nazwa'];
        $this->NIP = $row['NIP'];
        $this->Bank = $row['Bank'];

    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET Nazwa=:Nazwa, NIP=:NIP, Bank=:Bank WHERE ID_kontrahenta = :ID_kontrahenta";
        $stmt = $this->conn->prepare($query);

        $this->Nazwa = htmlspecialchars(strip_tags($this->Nazwa));
        $this->NIP = htmlspecialchars(strip_tags($this->NIP));
        $this->Bank = htmlspecialchars(strip_tags($this->Bank));
        $this->ID_kontrahenta = htmlspecialchars(strip_tags($this->ID_kontrahenta));

        $stmt->bindParam(":Nazwa", $this->Nazwa);
        $stmt->bindParam(":NIP", $this->NIP);
        $stmt->bindParam(":Bank", $this->Bank);
        $stmt->bindParam(":ID_kontrahenta", $this->ID_kontrahenta);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE NIP=:NIP";
        $stmt = $this->conn->prepare($query);

        $this->ID_kontrahenta = htmlspecialchars(strip_tags($this->NIP));
        $stmt->bindParam(":NIP", $this->NIP);

        if ($stmt->execute()) {
            return true;
        }

        return false;
        
    
    }
}
