<?php

require "../db.inc.php";

class Ulesrend
{
    private $id;
    private $nev;
    private $sor;
    private $oszlop;
    private $jelszo;
    private $felhasznalonev;




    public function set_user($id, $conn)
    {
        //adatbázisból lekérdezzük
        $sql = "SELECT id, nev, sor, oszlop, jelszo, felhasznalonev FROM ulesrend";
        $sql .= " WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->nev = $row['nev'];
            $this->sor = $row['sor'];
            $this->oszlop = $row['oszlop'];
            $this->jelszo = $row['jelszo'];
            $this->felhasznalonev = $row['felhasznalonev'];
        } 

      
    } //set_user

    public function get_user($id, $conn)
    {
        //adatbázisból lekérdezzük
        $sql = "SELECT id, nev, sor, oszlop, jelszo, felhasznalonev FROM ulesrend";
        $sql .= " WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->nev = $row['nev'];
            $this->sor = $row['sor'];
            $this->oszlop = $row['oszlop'];
            $this->jelszo = $row['jelszo'];
            $this->felhasznalonev = $row['felhasznalonev'];
            return $row;
        } else {
            return FALSE;
        }

        //visszaadjuk 
    }//get_user


    public function get_username(){
        
        return $this->nev;

    }





}//class

$tanulo = new Ulesrend;
$tanulo -> set_user(4, $conn);

echo  $tanulo -> get_username();


?>