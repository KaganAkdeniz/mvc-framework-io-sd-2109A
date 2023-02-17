<h3><u><?= $data['title']; ?></u></h3><br>
<h5>Naam: <?= $data['voornaam'] . ' ' . $data['tussenvoegsel'] . ' ' . $data['achternaam']; ?></h5>
<h5>Datum in dienst: <?= date_format(date_create($data['datumInDienst']), 'd-m-Y'); ?></h5>
<h5>Aantal sterren: <?= $data['aantalSterren']; ?></h5><br>