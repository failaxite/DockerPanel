<?php
$containerId = $_GET['id']; 
$containerDetails = obtenirDetailsDuConteneur($containerId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Détails du Conteneur Docker</title>
</head>
<body>
    <?php include 'templates/navbar.php';?>

    <div class="content">
        <h1>Détails du Conteneur Docker :</h1>
        <table class="container-details">
            <tbody>
                <tr>
                    <td><strong>ID du Conteneur :</strong></td>
                    <td><?php echo $containerDetails->Id; ?></td>
                </tr>
                <tr>
                    <td><strong>Nom du Conteneur :</strong></td>
                    <td><?php echo $containerDetails->Name; ?></td>
                </tr>
                <tr>
                    <td><strong>Image du Conteneur :</strong></td>
                    <td><?php echo $containerDetails->Image; ?></td>
                </tr>
                <tr>
                    <td><strong>Date de Création :</strong></td>
                    <td><?php echo $containerDetails->Created; ?></td>
                </tr>
                <tr>
                    <td><strong>Commande :</strong></td>
                    <td><?php echo $containerDetails->Command; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>


<?php

function obtenirDetailsDuConteneur($containerId) {
    $dockerApiUrl = 'http://localhost:2375';
    $containerDetailsEndpoint = '/containers/' . $containerId . '/json';

    $containerDetails = file_get_contents($dockerApiUrl . $containerDetailsEndpoint);

    return json_decode($containerDetails);
}


?>
