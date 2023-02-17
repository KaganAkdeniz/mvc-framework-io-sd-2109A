<?php

class Instructeur extends Controller
{
    //properties
    private $instructeurModel;

    // Dit is de constructor van de controller
    public function __construct() 
    {
        $this->instructeurModel = $this->model('InstructeurModel');
    }

    public function index()
    {
        $instructeurs = $this->instructeurModel->getInstructeurs();
        //var_dump($records);

        $rows = '';

        foreach ($instructeurs as $items)
        {
            $rows .= "<tr>
                        <td>$items->Id</td>
                        <td>$items->Voornaam</td>
                        <td>$items->Tussenvoegsel</td>
                        <td>$items->Achternaam</td>
                        <td>$items->Mobiel</td>
                        <td>$items->DatumInDienst</td>
                        <td>$items->AantalSterren</td>
                        <td>
                            <a href='" . URLROOT . "/instructeur/gebruikteVoertuigen/$items->Id'>voertuigen</a>
                        </td>
                        <td>
                            <a href='" . URLROOT . "/instructeur/delete/$items->Id'>delete</a>
                        </td>
                      </tr>";
        }
        $data = [
      'title' => 'Instructeurs in dienst',
      'amountOfInstructeurs' => sizeof($instructeurs),
      'rows' => $rows
    ];
     $this->view('/instructeur/index', $data);
        
    }

    public function GebruikteVoertuigen($Id)
    {
        $instructeur = $this->instructeurModel->GetInstructeurById($Id);

        $gebruikteVoertuigen = $this->instructeurModel->GetGebruikteVoertuigen($Id);
        var_dump($gebruikteVoertuigen);
        if (sizeOf($gebruikteVoertuigen) == 0){
        $rows = "<tr><td colspan='6'>Er zijn op dit moment nog geen voertuigen toegewezen aan deze instructeur</td></tr>";

        } else {
            $rows = '';
            foreach ($gebruikteVoertuigen as $items){
                $rows .= "<tr>
                         <td>$items->TypeVoertuig</td>
                         <td>$items->Type</td>
                         <td>$items->Kenteken</td>
                         <td>$items->Bouwjaar</td>
                         <td>$items->Brandstof</td>
                         <td>$items->Rijbewijscategorie</td>
                         <td>
                         <a href='" . URLROOT . "/instructeur/update/$items->Id/$Id'>voertuigen</a>
                        </td>
                         </tr>";
            }
        }
        $data = [
        'title' => 'Door Instructeur gebruikte voertuigen',
        'voornaam' => $instructeur->Voornaam,
        'tussenvoegsel' => $instructeur->Tussenvoegsel,
        'achternaam' => $instructeur->Achternaam,
        'datumInDienst' => $instructeur->DatumInDienst,
        'aantalSterren' => $instructeur->AantalSterren,
        'rows' =>$rows
    ];

    $this->view('/instructeur/gebruikteVoertuigen', $data);
  }

    public function update($Id = null, $instructeurId = NULL) 
    {
        echo $Id;
        echo "<br>";
        echo $instructeurId;
        // exit();
        /**
         * Controleer of er gepost wordt vanuit de view update.php
         */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            /**
             * Maak het $_POST array schoon
             */
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->instructeurModel->updateInstructeur($_POST);

        }

        $record = $this->instructeurModel->getInstructeurById($instructeurId);

        $voertuigInfo = $this->instructeurModel->getVoertuigById($Id);


        $data = [
        'title' => 'Door Instructeur gebruikte voertuigen updaten',
        'voornaam' => $record->Voornaam,
        'tussenvoegsel' => $record->Tussenvoegsel,
        'achternaam' => $record->Achternaam,
        'datumInDienst' => $record->DatumInDienst,
        'aantalSterren' => $record->AantalSterren,
        'rows' =>$rows
    ];
        $this->view('instructeur/update', $data);
    }
 }
    




