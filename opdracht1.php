<?php 

if (isset($_POST['Knop'])) {
    $bedrag = $_POST['Bedrag'];
    $aantalPersonen = $_POST['AantalPersonen'];
    $fooi = $_POST['Fooi'];

    if ($aantalPersonen > 1 && $bedrag > 1) {
        $totaalBedrag= $bedrag + $fooi;
        $result = $totaalBedrag / $aantalPersonen;

        echo "Het bedrag dat je per persoon moet betalen is $result";
    }

} else {
    echo "Vul eerst het form in.";
}

?>

<!DOCTYPE HTML>
<html lang="lang">
<head>
    <meta charset="UTF-8">
    <meta name="viewpoort" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    <form method="POST">
    <input type="number" name="AantalPersonen" placeholder="Aantal personen">
    <input type="number" name="Bedrag" placeholder="Bedrag">
    <input type="number" name="Fooi" placeholder="Fooi">

    <input type="submit" name="Knop">
    </form>

</html>