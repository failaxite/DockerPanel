<?php

if (isset($_GET['id'])) {
    $containerId = $_GET['id'];

    // Configuration de l'URL de l'API Docker
    $dockerApiUrl = 'http://localhost:2375';

    // Configuration de la requête HTTP POST
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode([]),
        ],
    ];

    // Créez le contexte de la requête
    $context = stream_context_create($options);

    try {
        // Envoyez la requête HTTP POST pour arrêter le conteneur
        $response = file_get_contents("$dockerApiUrl/containers/$containerId/stop", false, $context);

        if ($response === false) {
            echo "Impossible d'arrêter le conteneur. Erreur lors de la requête HTTP.";
        } else {
            echo "Le conteneur avec l'ID $containerId a été arrêté avec succès.";
        }
    } catch (Exception $e) {
        echo "Une erreur s'est produite lors de la requête HTTP : " . $e->getMessage();
    }
} else {
    echo "ID du conteneur non spécifié.";
}

// Redirection vers containers.php après l'action
header("Location: containers.php");
exit;
?>

