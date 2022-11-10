<?php

/**
 * Dit is de model voor de controller Countries
 */

class Country
{
    //properties
    private $db;

    // Dit is de constructor van de Country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCountries()
    {
        $this->db->query('SELECT * FROM Country');
        return $this->db->resultSet();
    }

    public function getCountry($id)
    {
        $this->db->query("SELECT * FROM Country WHERE Id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function updateCountry($data)
    {
        // var_dump($data);exit();
        $this->db->query("UPDATE Country
                          SET Name = :Name,
                              CapitalCity = :CapitalCity,
                              Continent = :Continent,
                              Population = :Population
                          WHERE Id = :Id");

        $this->db->bind(':Name', $data['name'], PDO::PARAM_STR);
        $this->db->bind(':CapitalCity', $data['capitalCity'], PDO::PARAM_STR);
        $this->db->bind(':Continent', $data['continent'], PDO::PARAM_STR);
        $this->db->bind(':Population', $data['population'], PDO::PARAM_INT);
        $this->db->bind(':Id', $data['id'], PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function deleteCountry($id)
    {
        $this->db->query("DELETE FROM country WHERE Id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function createCountry($post)
    {
        $this->db->query("INSERT INTO country (Id, 
                                               Name, 
                                               CapitalCity, 
                                               Continent, 
                                               Population)
                          VALUES              (:Id,
                                               :Name,
                                               :CapitalCity,
                                               :Continent,
                                               :Population)");
        $this->db->bind(':Id', NULL, PDO::PARAM_NULL);
        $this->db->bind(':Name', $post['name'], PDO::PARAM_STR);
        $this->db->bind(':CapitalCity', $post['capitalCity'], PDO::PARAM_STR);
        $this->db->bind(':Continent', $post['continent'], PDO::PARAM_STR);
        $this->db->bind(':Population', $post['population'], PDO::PARAM_INT);
        return $this->db->execute();

    }


}