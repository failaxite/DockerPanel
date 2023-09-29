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
    <style>
        /* Styles pour le tableau */
        .container-details {
            border-collapse: collapse;
            width: 100%;
        }

        .container-details th, .container-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .container-details th {
            background-color: #f2f2f2;
        }

        /* Styles pour les cellules avec des valeurs "Oui" ou "Non" */
        .container-details td.bool-true {
            color: green;
            font-weight: bold;
        }

        .container-details td.bool-false {
            color: red;
            font-weight: bold;
        }

                /* Styles pour le tableau */
        .container-details {
            border-collapse: collapse;
            width: 100%;
        }

        .container-details th, .container-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .container-details th {
            background-color: #f2f2f2;
        }

        /* Styles pour les cellules avec des valeurs "Oui" ou "Non" */
        .container-details td.bool-true {
            color: green;
            font-weight: bold;
        }

        .container-details td.bool-false {
            color: red;
            font-weight: bold;
        }

        /* Styles pour les écrans de petite taille (moins de 600px de large) */
        @media screen and (max-width: 600px) {
            .container-details {
                font-size: 12px; /* Réduire la taille de la police */
            }
            .container-details th, .container-details td {
                padding: 4px;
            }
        }

    </style>
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
                <td><?php echo $containerDetails->Path; ?></td>
            </tr>
            <tr>
                <td><strong>Args :</strong></td>
                <td><?php echo isset($containerDetails->Args) ? implode(' ', $containerDetails->Args) : 'N/A'; ?></td>
            </tr>

            <!-- State -->
            <tr>
                <td><strong>État :</strong></td>
                <td><?php echo $containerDetails->State->Status; ?></td>
            </tr>
            <tr>
                <td><strong>Running :</strong></td>
                <td><?php echo $containerDetails->State->Running ? 'Oui' : 'Non'; ?></td>
            </tr>
            <tr>
                <td><strong>Paused :</strong></td>
                <td><?php echo $containerDetails->State->Paused ? 'Oui' : 'Non'; ?></td>
            </tr>
            <tr>
                <td><strong>Restarting :</strong></td>
                <td><?php echo $containerDetails->State->Restarting ? 'Oui' : 'Non'; ?></td>
            </tr>
            <tr>
                <td><strong>OOMKilled :</strong></td>
                <td><?php echo $containerDetails->State->OOMKilled ? 'Oui' : 'Non'; ?></td>
            </tr>
            <tr>
                <td><strong>Dead :</strong></td>
                <td><?php echo $containerDetails->State->Dead ? 'Oui' : 'Non'; ?></td>
            </tr>
            <tr>
                <td><strong>Pid :</strong></td>
                <td><?php echo $containerDetails->State->Pid; ?></td>
            </tr>
            <tr>
                <td><strong>ExitCode :</strong></td>
                <td><?php echo $containerDetails->State->ExitCode; ?></td>
            </tr>
            <tr>
                <td><strong>Erreur :</strong></td>
                <td><?php echo $containerDetails->State->Error; ?></td>
            </tr>
            <tr>
                <td><strong>StartedAt :</strong></td>
                <td><?php echo $containerDetails->State->StartedAt; ?></td>
            </tr>
            <tr>
                <td><strong>FinishedAt :</strong></td>
                <td><?php echo $containerDetails->State->FinishedAt; ?></td>
            </tr>

            <!-- Autres variables -->
            <tr>
                <td><strong>ResolvConfPath :</strong></td>
                <td><?php echo $containerDetails->ResolvConfPath; ?></td>
            </tr>
            <tr>
                <td><strong>HostnamePath :</strong></td>
                <td><?php echo $containerDetails->HostnamePath; ?></td>
            </tr>
            <tr>
                <td><strong>HostsPath :</strong></td>
                <td><?php echo $containerDetails->HostsPath; ?></td>
            </tr>
            <tr>
                <td><strong>LogPath :</strong></td>
                <td><?php echo $containerDetails->LogPath; ?></td>
            </tr>
            <tr>
                <td><strong>RestartCount :</strong></td>
                <td><?php echo $containerDetails->RestartCount; ?></td>
            </tr>
            <tr>
                <td><strong>Driver :</strong></td>
                <td><?php echo $containerDetails->Driver; ?></td>
            </tr>
            <tr>
                <td><strong>Platform :</strong></td>
                <td><?php echo $containerDetails->Platform; ?></td>
            </tr>
            <tr>
                <td><strong>MountLabel :</strong></td>
                <td><?php echo $containerDetails->MountLabel; ?></td>
            </tr>
            <tr>
                <td><strong>ProcessLabel :</strong></td>
                <td><?php echo $containerDetails->ProcessLabel; ?></td>
            </tr>
            <tr>
                <td><strong>AppArmorProfile :</strong></td>
                <td><?php echo $containerDetails->AppArmorProfile; ?></td>
            </tr>
            <tr>
                <td><strong>ExecIDs :</strong></td>
                <td><?php echo json_encode($containerDetails->ExecIDs); ?></td>
            </tr>

            <!-- HostConfig -->
            <tr>
                <td><strong>HostConfig - Binds :</strong></td>
                <td><?php echo json_encode($containerDetails->HostConfig->Binds); ?></td>
            </tr>
            <tr>
                <td><strong>HostConfig - ContainerIDFile :</strong></td>
                <td><?php echo $containerDetails->HostConfig->ContainerIDFile; ?></td>
            </tr>
            <tr>
                <td><strong>GraphDriver - Data - LowerDir :</strong></td>
                <td><?php echo $containerDetails->GraphDriver->Data->LowerDir; ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</body>
</html>
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
