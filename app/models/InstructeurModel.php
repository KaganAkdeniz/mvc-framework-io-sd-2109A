<?php

Class InstructeurModel{
    private $db;

     public function __construct()
    {
        $this->db = new Database();
    }

     public function getInstructeurs()
    {
        $this->db->query('SELECT * FROM Instructeur1');
        return $this->db->resultSet();
    }

    public function getInstructeurById($Id) 
    {
        $sql = "SELECT  Instructeur1.Voornaam
                        ,Instructeur1.Tussenvoegsel
                        ,Instructeur1.Achternaam
                        ,Instructeur1.DatumInDienst
                        ,Instructeur1.AantalSterren
                        FROM Instructeur1 
                        WHERE Id = :Id";
        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        $result = $this->db->single();
        return $result;

    //      public function getCountry($id)
    // {
    //     $this->db->query("SELECT * FROM Country WHERE Id = :id");
    //     $this->db->bind(':id', $id, PDO::PARAM_INT);
    //     return $this->db->single();
    // }

    }

        public function getGebruikteVoertuigen($Id) 
    {
        $sql = "SELECT   TypeVoertuig.TypeVoertuig
                        ,Typevoertuig.Rijbewijscategorie
                        ,Voertuig.Id
                        ,Voertuig.Type
                        ,Voertuig.Kenteken
                        ,Voertuig.Bouwjaar
                        ,Voertuig.Brandstof

                FROM    Instructeur1
                INNER JOIN VoertuigInstructeur
                ON         VoertuigInstructeur.Instructeur1Id = Instructeur1.Id
                INNER JOIN Voertuig
                ON         VoertuigInstructeur.VoertuigId = Voertuig.Id
                INNER JOIN TypeVoertuig
                ON         Voertuig.TypeVoertuigId = TypeVoertuig.Id
                WHERE   Instructeur1.Id = :Id
                ORDER BY TypeVoertuig.Rijbewijscategorie ASC";
        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        $result = $this->db->resultSet();
        return $result;
    }


    // TODO:
    public function getVoertuigById($Id) 
    {
        $sql = "SELECT   Voertuig.*
                        ,TypeVoertuig.*
                         FROM Voertuig  
                         INNER JOIN TypeVoertuig
                         ON         Voertuig.TypeVoertuigId = TypeVoertuig.Id
                         WHERE Voertuig.Id = :Id;";
        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        $result = $this->db->single();
        return $result;
    }


        // TODO:
        public function updateInstructeur($data)
    {
        // var_dump($data);exit();
        $this->db->query("UPDATE Instructeur1
                         SET TypeVoertuig = :TypeVoertuig,
                             Type = :Type,
                             Kenteken = :Kenteken,
                             Bouwjaar = :Bouwjaar,
                             Brandstof = :Brandstof,
                             Rijbewijscategorie = :Rijbewijscategorie
                             WHERE Id =:Id");

          $this->db->bind(':Type', $data['type'], PDO::PARAM_STR);
          $this->db->bind(':Kenteken', $data['kenteken'], PDO::PARAM_STR);
          $this->db->bind(':Bouwjaar', $data['bouwjaar'], PDO::PARAM_STR);
          $this->db->bind(':Brandstof', $data['brandstof'], PDO::PARAM_STR);
          $this->db->bind(':Rijbewijscategorie', $data['rijbewijscategorie'], PDO::PARAM_STR);

 

                        //   SET Name = :Name,
                        //       CapitalCity = :CapitalCity,
                        //       Continent = :Continent,
                        //       Population = :Population
                        //   WHERE Id = :Id");

    //   $this->db->bind(':Name', $data['name'], PDO::PARAM_STR);
    //   $this->db->bind(':CapitalCity', $data['capitalCity'], PDO::PARAM_STR);
    //   $this->db->bind(':Continent', $data['continent'], PDO::PARAM_STR);
    //   $this->db->bind(':Population', $data['population'], PDO::PARAM_INT);
    //   $this->db->bind(':Id', $data['id'], PDO::PARAM_INT);

        return $this->db->execute();
    }
}