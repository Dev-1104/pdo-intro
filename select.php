<?php
require 'db_connect.php'; // Zorg ervoor dat dit bestand je databaseverbinding bevat

$sql = "SELECT * FROM producten"; // Pas de tabelnaam aan indien nodig
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Producten</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optioneel: CSS-bestand -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin-right: 5px;
        }
        .edit-btn {
            background-color: blue;
        }
        .delete-btn {
            background-color: red;
        }
    </style>
</head>
<body>

<h2>Overzicht Producten</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['naam']) . "</td>";
                echo "<td>€" . number_format($row['prijs'], 2, ',', '.') . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "' class='btn edit-btn'>Edit</a>
                        <a href='delete.php?id=" . $row['id'] . "' class='btn delete-btn' onclick='return confirm(\"Weet je zeker dat je dit product wilt verwijderen?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Geen producten gevonden</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close(); // Sluit de databaseverbinding
?>
