<?php

class Contact_persons
{
    private $conn;
    private $table_name = "osoby_kontaktowe";

    public $ID_osoby_kontaktowej;
    public $ID_siedziby;
    public $Imie;
    public $Nazwisko;
    public $Telefon;
    public $Opis;
    public $Adres;
    
    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function read()
    {
        $query = "SELECT ID_osoby_kontaktowej, ID_siedziby, Imie, Nazwisko, Telefon, Opis, Adres FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET ID_siedziby=:ID_siedziby, Imie=:Imie, Nazwisko=:Nazwisko,Telefon=:Telefon,Opis=:Opis,Adres=:Adres";
        $stmt = $this->conn->prepare($query);

        $this->ID_siedziby = htmlspecialchars(strip_tags($this->ID_siedziby));
        $this->Imie = htmlspecialchars(strip_tags($this->Imie));
        $this->Nazwisko = htmlspecialchars(strip_tags($this->Nazwisko));
        $this->Telefon = htmlspecialchars(strip_tags($this->Telefon));
        $this->Opis = htmlspecialchars(strip_tags($this->Opis));
        $this->Adres = htmlspecialchars(strip_tags($this->Adres));

        $stmt->bindParam(":ID_siedziby", $this->ID_siedziby);
        $stmt->bindParam(":Imie", $this->Imie);
        $stmt->bindParam(":Nazwisko", $this->Nazwisko);
        $stmt->bindParam(":Telefon", $this->Telefon);
        $stmt->bindParam(":Opis", $this->Opis);
        $stmt->bindParam(":Adres", $this->Adres);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readOne()
    {
        $query = "SELECT ID_osoby_kontaktowej, ID_siedziby, Imie, Nazwisko, Telefon, Opis, Adres FROM " . $this->table_name . " WHERE ID_osoby_kontaktowej = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_osoby_kontaktowej);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->ID_osoby_kontaktowej = $row['ID_osoby_kontaktowej'];
        $this->ID_siedziby = $row['ID_siedziby'];
        $this->Imie = $row['Imie'];
        $this->Nazwisko = $row['Nazwisko'];
        $this->Telefon = $row['Telefon'];
        $this->Opis = $row['Opis'];
        $this->Adres = $row['Adres'];

    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET ID_siedziby=:ID_siedziby, Imie=:Imie, Nazwisko=:Nazwisko,Telefon=:Telefon,Opis=:Opis,Adres=:Adres WHERE ID_osoby_kontaktowej = :ID_osoby_kontaktowej";
        $stmt = $this->conn->prepare($query);

        $this->ID_siedziby = htmlspecialchars(strip_tags($this->ID_siedziby));
        $this->Imie = htmlspecialchars(strip_tags($this->Imie));
        $this->Nazwisko = htmlspecialchars(strip_tags($this->Nazwisko));
        $this->Telefon = htmlspecialchars(strip_tags($this->Telefon));
        $this->Opis = htmlspecialchars(strip_tags($this->Opis));
        $this->Adres = htmlspecialchars(strip_tags($this->Adres));
        $this->ID_osoby_kontaktowej = htmlspecialchars(strip_tags($this->ID_osoby_kontaktowej));

        $stmt->bindParam(":ID_siedziby", $this->ID_siedziby);
        $stmt->bindParam(":Imie", $this->Imie);
        $stmt->bindParam(":Nazwisko", $this->Nazwisko);
        $stmt->bindParam(":Telefon", $this->Telefon);
        $stmt->bindParam(":Opis", $this->Opis);
        $stmt->bindParam(":Adres", $this->Adres);
        $stmt->bindParam(":ID_osoby_kontaktowej", $this->ID_osoby_kontaktowej);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_osoby_kontaktowej=:ID_osoby_kontaktowej";
        $stmt = $this->conn->prepare($query);

        $this->ID_osoby_kontaktowej = htmlspecialchars(strip_tags($this->ID_osoby_kontaktowej));
        $stmt->bindParam(":ID_osoby_kontaktowej", $this->ID_osoby_kontaktowej);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
