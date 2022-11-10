<?php

class Countries extends Controller
{
    //properties
    private $countryModel;

    // Dit is de constructor van de controller
    public function __construct() 
    {
        $this->countryModel = $this->model('Country');
    }

    public function index($land = 'Nederland', $age = 67)
    {
        $records = $this->countryModel->getCountries();
        //var_dump($records);

        $rows = '';

        foreach ($records as $items)
        {
            $rows .= "<tr>
                        <td>$items->Id</td>
                        <td>$items->Name</td>
                        <td>$items->CapitalCity</td>
                        <td>$items->Continent</td>
                        <td>$items->Population</td>
                        <td>
                            <a href='" . URLROOT . "/countries/update/$items->Id'>update</a>
                        </td>
                        <td>
                            <a href='" . URLROOT . "/countries/delete/$items->Id'>delete</a>
                        </td>
                      </tr>";
        }

        $data = [
            'title' => "Overzicht landen",
            'rows' => $rows
        ];
        $this->view('countries/index', $data);
    }

    public function update($id = null) 
    {
        /**
         * Controleer of er gepost wordt vanuit de view update.php
         */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            /**
             * Maak het $_POST array schoon
             */
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->countryModel->updateCountry($_POST);

            header("Location: " . URLROOT . "/country/index");
        }

        $record = $this->countryModel->getCountry($id);

        $data = [
            'title' => 'Update Landen',
            'Id' => $record->Id,
            'Name' => $record->Name,
            'CapitalCity' => $record->CapitalCity,
            'Continent' => $record->Continent,
            'Population' => $record->Population
        ]; 
        $this->view('countries/update', $data);
    }

    public function delete($id)
    {
        $result = $this->countryModel->deleteCountry($id);
        if ($result) {
            echo "Het record is verwijderd uit de database";
            header("Refresh: 3; URL=" . URLROOT . "/countries/index");
        } else {
            echo "Internal servererror, het record is niet verwijderd";
            header("Refresh: 3; URL=" . URLROOT . "/countries/index");
        }
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // $_POST array schoonmaken
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $result = $this->countryModel->createCountry($_POST);

            if ($result) {
                echo "Het invoeren is gelukt";
                header("Refresh:3; URL=" . URLROOT . "/countries/index");
            } else {
                echo "Het invoeren is NIET gelukt";
                header("Refresh:3; URL=" . URLROOT . "/countries/index");
            }
        }

        $data = [
            'title' => 'Voeg een nieuw land toe'
        ];
        $this->view('countries/create', $data);
    }
}