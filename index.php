<?php
$dockerApiUrl = 'http://localhost:2375';
$containerEndpoint = '/containers/json?all=1';

$dockerContainers = file_get_contents($dockerApiUrl . $containerEndpoint);
$dockerContainers = json_decode($dockerContainers);

if (!empty($dockerContainers)) {
    echo '<h1>Liste des conteneurs Docker :</h1>';
    echo '<ul>';
    foreach ($dockerContainers as $container) {
        echo '<li>' . $container->Names[0] . '</li>';
    }
    echo '</ul>';
} else {
    echo 'Aucun conteneur Docker en cours d\'exécution.';
}
?>
