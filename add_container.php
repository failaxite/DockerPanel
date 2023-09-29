<?php

if (isset($_POST['containerName'])) {
    $containerName = $_POST['containerName'];

    // Configuration de l'URL de l'API Docker
    $dockerApiUrl = 'http://localhost:2375';

    // Configuration des données pour la création du conteneur
    $data = [
        'Image' => 'nom_de_l_image', // Remplacez par le nom de l'image Docker que vous souhaitez utiliser
        'Cmd' => ['/bin/bash'], // Commande à exécuter dans le conteneur (peut être modifiée selon vos besoins)
    ];

    // Configuration de la requête HTTP POST
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data),
        ],
    ];

    // Créez le contexte de la requête
    $context = stream_context_create($options);

    try {
        // Envoyez la requête HTTP POST pour créer le conteneur
        $response = file_get_contents("$dockerApiUrl/containers/create?name=$containerName", false, $context);

        if ($response === false) {
            echo "Impossible de créer le conteneur. Erreur lors de la requête HTTP.";
        } else {
            // Analyser la réponse JSON
            $containerInfo = json_decode($response, true);

            // Vérifier si le conteneur a été créé avec succès
            if (isset($containerInfo['Id'])) {
                $containerId = $containerInfo['Id'];
                echo "Le conteneur avec l'ID $containerId a été créé avec succès.";
            } else {
                echo "Impossible de créer le conteneur. Réponse JSON non valide.";
            }
        }
    } catch (Exception $e) {
        echo "Une erreur s'est produite lors de la requête HTTP : " . $e->getMessage();
    }

    header("Location: containers.php");
    exit;
} else {
    echo "Nom du conteneur non spécifié.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un conteneur Docker</title>
</head>
<body>
    <h1>Ajouter un conteneur Docker</h1>
    <form method="POST">
        <label for="image_name">Nom de l'image Docker :</label>
        <input type="text" name="image_name" required>
        <br>
        <label for="container_name">Nom du conteneur :</label>
        <input type="text" name="container_name" required>
        <br>
        <input type="submit" value="Créer le conteneur">
    </form>
</body>
</html>
