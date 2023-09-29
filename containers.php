<?php
$dockerApiUrl = 'http://localhost:2375';
$containerEndpoint = '/containers/json?all=1';

$dockerContainers = file_get_contents($dockerApiUrl . $containerEndpoint);
$dockerContainers = json_decode($dockerContainers);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Liste des conteneurs Docker</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .docker-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        .docker-table th, .docker-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .docker-table th {
            background-color: #0696D7;
            color: #fff;
        }

        .docker-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .running-state {
            position: relative;
            background-color: #fff;
            color: #fff;
            border-radius: 200px;
            margin-top: 15px;
        }

        .running-state::before {
            content: "";
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background-color: #4CAF50; 
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 42;
        }


        .offline-state {
            position: relative;
            padding: 5px 10px;
            background-color: #fff;
            color: #fff;
            border-radius: 50%;
        }

        .offline-state::before {
            content: "";
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background-color: #FF5733;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 42;
        }

        .action-bubble {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px;
            border-radius: 5px;
            color: white;
            background-color: #4CAF50; /* Fond vert */
            z-index: 9999;
            margin-top: 25px;
        }

        /* Style des bulles d'information de succès */
        .success {
            background-color: #4CAF50;
        }

        /* Style des bulles d'information d'erreur */
        .error-bubble {
            background-color: #FF5733;
        }

        .warning-bubble {
            background-color: #FFA500;
        }

        .stop-icon {
            color: red;
        }

        /* Style pour l'icône de redémarrage (orange) */
        .restart-icon {
            color: orange;
        }

        /* Style pour l'icône de démarrage (vert) */
        .start-icon {
            color: green;
        }

        /* Style pour l'icône de suppression (rouge) */
        .delete-icon {
            color: red;
        }

        /* Ajoutez ces styles à votre fichier CSS */

        .add-container-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0696D7;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .add-container-button:hover {
            background-color: #0577b3;
        }


    </style>
</head>
<body>
    <?php include 'templates/navbar.php';?>

    <a href="adding_container.php" class="add-container-button">Ajouter un conteneur</a>

    <div class="content">
    <h1>Liste des conteneurs Docker :</h1>
    <table class="docker-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>ID</th>
                <th>Image</th>
                <th>État</th>
                <th>Actions</th> <!-- Ajout de la colonne Actions -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dockerContainers as $container) : ?>
                <tr>
                    <td><a href="container_details.php?id=<?php echo $container->Id; ?>"><?php echo $container->Names[0]; ?></a></td>
                    <td><?php echo $container->Id; ?></td>
                    <td><?php echo $container->Image; ?></td>
                    <td class="<?php echo ($container->State === 'running') ? 'running-state' : 'offline-state'; ?>"></td>
                    <td>
                        <!-- Boutons pour gérer le conteneur -->
                        <?php if ($container->State === 'running') : ?>
                            <a href="stop_container.php?id=<?php echo $container->Id; ?>" onclick="showMessage('Conteneur arrêté avec succès', 'error')"><i class="fas fa-stop-circle stop-icon"></i></a>
                            <a href="restart_container.php?id=<?php echo $container->Id; ?>" onclick="showMessage('Conteneur redémarré avec succès', 'warning')"><i class="fas fa-sync-alt restart-icon"></i></a>
                        <?php else : ?>
                            <a href="start_container.php?id=<?php echo $container->Id; ?>" onclick="showMessage('Conteneur démarré avec succès', 'success')"><i class="fas fa-play-circle start-icon"></i></a>
                        <?php endif; ?>
                        <a href="delete_container.php?id=<?php echo $container->Id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce conteneur ?'); showMessage('Conteneur supprimé avec succès', 'error')"><i class="fas fa-trash-alt delete-icon"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function showMessage(message, type) {
        var bubble = document.createElement("div");
        bubble.className = "action-bubble " + type + "-bubble";
        bubble.textContent = message;
        document.body.appendChild(bubble);
        setTimeout(function() {
            bubble.style.display = "none";
        }, 15000); // Masquer la bulle après 5 secondes
    }

</script>
</body>
</html>

