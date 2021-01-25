<?php

class json
{
    private $conn;
    private $table_name = "kontrahenci";
    private $table_name2 = "siedziby";

    public $ID_kontrahenta;
    public $Nazwa;
    public $NIP;
    public $Bank;
    public $Mail;
    public $Telefon;
    public $Miasto;
    public $Ulica;
    public $Numer_domu;
    public $Adres;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    //public function json()
    //{
     //   $query = "SELECT kontrahenci.ID_kontrahenta, kontrahenci.Nazwa, kontrahenci.NIP, CONCAT(siedziby.Miasto,', ',siedziby.Ulica,' ',siedziby.Numer_domu) as Adres, siedziby.Mail, siedziby.Telefon
       // FROM kontrahenci INNER JOIN siedziby ON kontrahenci.ID_kontrahenta=siedziby.ID_kontrahenta WHERE kontrahenci.NIP =: kontrahenci.NIP";
        //$stmt = $this->conn->prepare($query);
        //$stmt->execute();
        //return $stmt;
//    }
    public function json()
    {
        $query = "SELECT kontrahenci.ID_kontrahenta, kontrahenci.Nazwa, kontrahenci.NIP, kontrahenci.Bank, CONCAT(siedziby.Miasto,', ',siedziby.Ulica,' ',siedziby.Numer_domu) as Adres, siedziby.Mail, siedziby.Telefon
        FROM kontrahenci INNER JOIN siedziby ON kontrahenci.NIP=siedziby.NIP WHERE kontrahenci.NIP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NIP);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->ID_kontrahenta = $row['ID_kontrahenta'];
        $this->Nazwa = $row['Nazwa'];
        $this->NIP = $row['NIP'];
        $this->Adres = $row['Adres'];
        //$this->Miasto = $row['Miasto'];
        //$this->Ulica = $row['Ulica'];
        //$this->Numer_domu = $row['Numer_domu'];
        $this->Mail = $row['Mail'];
        $this->Telefon = $row['Telefon'];
        $this->Bank = $row['Bank'];

    }

}
