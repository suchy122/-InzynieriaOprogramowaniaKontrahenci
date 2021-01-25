<?php

class hq
{
    private $conn;
    private $table_name = "siedziby";

    public $ID_siedziby;
    public $NIP;
    public $Miasto;
    public $Fax;
    public $Mail;
    public $Telefon;
    public $Kod_pocztowy;
    public $Numer_domu;
    public $Ulica;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function read()
    {
        $query = "SELECT ID_siedziby, NIP, Miasto, Fax, Mail, Telefon, Kod_pocztowy, Numer_domu, Ulica FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Miasto=:Miasto, Fax=:Fax, Mail=:Mail, Telefon=:Telefon, Kod_pocztowy=:Kod_pocztowy,Numer_domu=:Numer_domu, Ulica=:Ulica, NIP=:NIP";
        $stmt = $this->conn->prepare($query);

        
        $this->Miasto = htmlspecialchars(strip_tags($this->Miasto));
        $this->Fax = htmlspecialchars(strip_tags($this->Fax));
        $this->Mail = htmlspecialchars(strip_tags($this->Mail));
        $this->Telefon = htmlspecialchars(strip_tags($this->Telefon));
        $this->Kod_pocztowy = htmlspecialchars(strip_tags($this->Kod_pocztowy));
        $this->Numer_domu = htmlspecialchars(strip_tags($this->Numer_domu));
        $this->Ulica = htmlspecialchars(strip_tags($this->Ulica));
        $this->NIP = htmlspecialchars(strip_tags($this->NIP));
        
        $stmt->bindParam(":Miasto", $this->Miasto);
        $stmt->bindParam(":Fax", $this->Fax);
        $stmt->bindParam(":Mail", $this->Mail);
        $stmt->bindParam(":Telefon", $this->Telefon);
        $stmt->bindParam(":Kod_pocztowy", $this->Kod_pocztowy);
        $stmt->bindParam(":Numer_domu", $this->Numer_domu);
        $stmt->bindParam(":Ulica", $this->Ulica);
        $stmt->bindParam(":NIP", $this->NIP);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readOne()
    {
        $query = "SELECT ID_siedziby, NIP, Miasto, Fax, Mail, Telefon, Kod_pocztowy, Numer_domu, Ulica FROM " . $this->table_name . " WHERE ID_siedziby = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_siedziby);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->NIP = $row['NIP'];
        $this->Miasto = $row['Miasto'];
        $this->Fax = $row['Fax'];
        $this->Mail = $row['Mail'];
        $this->Telefon = $row['Telefon'];
        $this->Kod_pocztowy = $row['Kod_pocztowy'];
        $this->Numer_domu = $row['Numer_domu'];
        $this->Ulica = $row['Ulica'];

    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET NIP=:NIP, Miasto=:Miasto, Fax=:Fax, Mail=:Mail, Telefon=:Telefon, Kod_pocztowy=:Kod_pocztowy,
        Numer_domu=:Numer_domu, Ulica=:Ulica WHERE ID_siedziby = :ID_siedziby";
        $stmt = $this->conn->prepare($query);

        $this->NIP = htmlspecialchars(strip_tags($this->NIP));
        $this->Miasto = htmlspecialchars(strip_tags($this->Miasto));
        $this->Fax = htmlspecialchars(strip_tags($this->Fax));
        $this->Mail = htmlspecialchars(strip_tags($this->Mail));
        $this->Telefon = htmlspecialchars(strip_tags($this->Telefon));
        $this->Kod_pocztowy = htmlspecialchars(strip_tags($this->Kod_pocztowy));
        $this->Numer_domu = htmlspecialchars(strip_tags($this->Numer_domu));
        $this->Ulica = htmlspecialchars(strip_tags($this->Ulica));
        $this->ID_siedziby = htmlspecialchars(strip_tags($this->ID_siedziby));

        $stmt->bindParam(":NIP", $this->NIP);
        $stmt->bindParam(":Miasto", $this->Miasto);
        $stmt->bindParam(":Fax", $this->Fax);
        $stmt->bindParam(":Mail", $this->Mail);
        $stmt->bindParam(":Telefon", $this->Telefon);
        $stmt->bindParam(":Kod_pocztowy", $this->Kod_pocztowy);
        $stmt->bindParam(":Numer_domu", $this->Numer_domu);
        $stmt->bindParam(":Ulica", $this->Ulica);
        $stmt->bindParam(":ID_siedziby", $this->ID_siedziby);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_siedziby=:ID_siedziby";
        $stmt = $this->conn->prepare($query);

        $this->ID_siedziby = htmlspecialchars(strip_tags($this->ID_siedziby));
        $stmt->bindParam(":ID_siedziby", $this->ID_siedziby);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
