<?php
/**
 * Dit is de model voor de controller Lessen
 */

class Les
{
    //properties
    private $db;

    // Dit is de constructor van de Country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLessen()
    {
        $this->db->query("SELECT Les.DatumTijd
                                ,Les.Id as LEID
                                ,Leerling.Id
                                ,Leerling.Naam as LENA
                                ,Instructeur.Naam as INNA
                          FROM Les
                          INNER JOIN Leerling
                          ON Leerling.Id = Les.LeerlingId
                          INNER JOIN Instructeur
                          ON Instructeur.Id = Les.InstructeurId
                          WHERE Les.InstructeurId = :Id");

        $this->db->bind(':Id', 2, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public function getTopics($lessonId)
    {
        // Maak je query
        $sql = "SELECT Les.DatumTijd
                      ,Les.Id
                      ,Onderwerp.Onderwerp
                FROM Onderwerp
                INNER JOIN Les
                ON Les.Id = Onderwerp.LesId
                WHERE LesId = :lessonId";

        // Prepareer je query
        $this->db->query($sql);

        // Bind de echte waarde aan de placeholder
        $this->db->bind(':lessonId', $lessonId, PDO::PARAM_INT);

        // Haal je resultaat op en return deze.
        return $this->db->resultSet();
    }

    public function addTopic($post)
    {
        $sql = "INSERT INTO Onderwerp (LesId
                                      ,Onderwerp)
                VALUES                (:lesId,
                                       :topic);";

        $this->db->query($sql);

        $this->db->bind(':lesId', $post['id'], PDO::PARAM_INT);
        $this->db->bind(':topic', $post['topic'], PDO::PARAM_STR);

        return $this->db->execute();
    }
}