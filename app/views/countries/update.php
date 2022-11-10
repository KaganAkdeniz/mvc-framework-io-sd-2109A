<h3><?= $data['title']; ?></h3>

<form action="<?= URLROOT; ?>/countries/update" method="post">
    <table>
        <tbody>
            <tr>
                <td>Land:</td>
                <td><input type="text" name="name" id="name" value="<?= $data['Name']; ?>"></td>
            </tr>
            <tr>
                <td>Hoofstad:</td>
                <td><input type="text" name="capitalCity" id="capitalCity" value="<?= $data['CapitalCity']; ?>"></td>
            </tr>
            <tr>
                <td>Continent:</td>
                <td><input type="text" name="continent" id="continent" value="<?= $data['Continent']; ?>"></td>
            </tr>
            <tr>
                <td>Aantal inwoners:</td>
                <td><input type="text" name="population" id="population" value="<?= $data['Population']; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" id="id" value="<?= $data['Id']; ?>"></td>
                <td><input type="submit" name="submit" id="submit" value="Verstuur"></td>
            </tr>
        </tbody>
    </table>

</form>