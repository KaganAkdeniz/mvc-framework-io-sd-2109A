<h3><?= $data['title'] ?></h3>
<a href="<?= URLROOT ?>/countries/create">Nieuw record</a>
<table>
    <thead>
        <th>Id</th>
        <th>Naam</th>
        <th>Hooftstad</th>
        <th>Continent</th>
        <th>Aantal Inwoners</th>
        <th>Update</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>
<p><a href="<?= URLROOT; ?>/landingpages/index">back to landingpage</a></p>