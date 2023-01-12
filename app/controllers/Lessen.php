<?php

class Lessen extends Controller
{
    private $lesModel;

    public function __construct()
    {
        // We maken een object van de model class en stoppen dit in $lesModel
        $this->lesModel = $this->model('Les');
    }

    public function index()
    {
        $result = $this->lesModel->getLessen();

        // var_dump($result);

        $rows = "";

        foreach ($result as $lesinfo) {
            $dateTimeObj = 
                new DateTimeImmutable($lesinfo->DatumTijd, 
                                      new DateTimeZone('Europe/Amsterdam'));
            // var_dump($dateTimeObj);
            $rows .= "<tr>
                        <td>{$dateTimeObj->format('d-m-Y')}</td>
                        <td>{$dateTimeObj->format('H:i')}</td>
                        <td>{$lesinfo->LENA}</td>
                        <td></td>
                        <td>
                            <a href='" . URLROOT . "/lessen/topiclesson/{$lesinfo->LEID}'>
                                <img src='" . URLROOT . "/img/b_sbrowse.png' alt='table picture'>
                            </a>
                        </td>
                      </tr>";
        }


        $data = [
            'title' => 'Overzicht Lessen',
            'rows' => $rows,
            'instructorName' => $result[0]->INNA
        ];
        $this->view('lessen/index', $data);
    }

    public function topicLesson($id = NULL)
    {
        // Roep de modelmethod getTopics aan
        $result = $this->lesModel->getTopics($id);

        if ($result) {
            $dt = new DateTimeImmutable($result[0]->DatumTijd, new DateTimeZone('Europe/Amsterdam'));
            $date = $dt->format('d-m-Y');
            $time = $dt->format('H:i');            
        } else {
            $date = "";
            $time = "";
        }

        $rows = "";

        foreach ($result as $topic) {

            $rows .= "<tr>
                        <td>{$topic->Onderwerp}</td>
                      </tr>";
        }


        $data = [
            'title' => 'Onderwerpen Les',
            'rows' => $rows,
            'date' => $date,
            'time' => $time,
            'lessonId' => $id
        ];
        $this->view('lessen/topiclesson', $data);
    }

    public function addTopic($id = NULL) 
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $result = $this->lesModel->addTopic($_POST);

            if($result) {
                echo "<h3>de data is opgeslagen</h3>";
                header('Refresh:3; url=' . URLROOT . '/lessen/index');
            } else {
                echo "<h3>de data is niet opgeslagen</h3>";
                header('Refresh:3; url=' . URLROOT . '/lessen/index');
            }
        } else {

            $data = [
                'title' => 'Onderwerp Toevoegen',
                'id' =>$id
            ];
    
            $this->view('lessen/addTopic', $data);
        }

    }
}
