<?php

$containerId = $_GET['id'];

$dockerApiUrl = 'http://localhost:2375';

$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode([]),
    ],
];

$context = stream_context_create($options);

try {
    $response = file_get_contents("$dockerApiUrl/containers/$containerId/start", false, $context);

    if ($response === false) {
        echo "Impossible de démarrer le conteneur. Erreur lors de la requête HTTP.";
    } else {
        echo "Le conteneur avec l'ID $containerId a été démarré avec succès.";
    }
} catch (Exception $e) {
    echo "Une erreur s'est produite lors de la requête HTTP : " . $e->getMessage();
}

header("Location: containers.php");
exit;
?>
