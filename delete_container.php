<?php

if (isset($_GET['id'])) {
    $containerId = $_GET['id'];

    // Configuration de l'URL de l'API Docker
    $dockerApiUrl = 'http://localhost:2375';

    // Configuration de la requête HTTP POST
    $options = [
        'http' => [
            'method' => 'DELETE',
        ],
    ];

    // Créez le contexte de la requête
    $context = stream_context_create($options);

    try {
        // Envoyez la requête HTTP DELETE pour supprimer le conteneur
        $response = file_get_contents("$dockerApiUrl/containers/$containerId", false, $context);

        if ($response === false) {
            echo "Impossible de supprimer le conteneur. Erreur lors de la requête HTTP.";
        } else {
            echo "Le conteneur avec l'ID $containerId a été supprimé avec succès.";
        }
    } catch (Exception $e) {
        echo "Une erreur s'est produite lors de la requête HTTP : " . $e->getMessage();
    }

    header("Location: containers.php");
    exit;
} else {
    echo "ID du conteneur non spécifié.";
}
?>
