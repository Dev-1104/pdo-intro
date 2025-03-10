<?php
// Vereis de databaseverbinding
require 'db.php';

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_naam = $_POST['product_naam'] ?? '';
    $prijs_per_stuk = $_POST['prijs_per_stuk'] ?? '';
    $omschrijving = $_POST['omschrijving'] ?? '';

    // Basisvalidatie (zorgt ervoor dat velden niet leeg zijn en dat prijs een nummer is)
    if (!empty($product_naam) && is_numeric($prijs_per_stuk) && !empty($omschrijving)) {
        $stmt = $db->prepare("INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $product_naam, $prijs_per_stuk, $omschrijving);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Product succesvol toegevoegd!</p>";
        } else {
            echo "<p style='color: red;'>Er is iets misgegaan.</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Vul alle velden correct in.</p>";
    }
}
// Voeg 5 producten toe (eenmalig uitvoeren)
$producten = [
    ['Laptop', 899.99, 'Een krachtige laptop met een snelle processor'],
    ['Smartphone', 499.99, 'Een moderne smartphone met uitstekende camera'],
    ['Koptelefoon', 79.99, 'Draadloze koptelefoon met ruisonderdrukking'],
    ['Muis', 29.99, 'Ergonomische draadloze muis'],
    ['Toetsenbord', 49.99, 'Mechanisch toetsenbord met RGB-verlichting']
];

foreach ($producten as $product) {
    $stmt = $db->prepare("INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $product[0], $product[1], $product[2]);
    $stmt->execute();
    $stmt->close();
}

echo "<p style='color: green;'>5 producten zijn automatisch toegevoegd aan de database.</p>";

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
</head>
<body>


<form method="POST">
    <label for="product_naam">Product Naam:</label>
    <input type="text" id="product_naam" name="product_naam" required><br><br>

    <label for="prijs_per_stuk">Prijs per stuk:</label>
    <input type="text" id="prijs_per_stuk" name="prijs_per_stuk" required><br><br>

    <label for="omschrijving">Omschrijving:</label>
    <textarea id="omschrijving" name="omschrijving" required></textarea><br><br>

    <button type="submit">Product Toevoegen</button>
</form>

</body>
</html>
