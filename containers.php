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
    </style>
</head>
<body>
    <h1>Liste des conteneurs Docker :</h1>
    <table class="docker-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>ID</th>
                <th>Image</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dockerContainers as $container) : ?>
                <tr>
                    <td><?php echo $container->Names[0]; ?></td>
                    <td><?php echo $container->Id; ?></td>
                    <td><?php echo $container->Image; ?></td>
                    <td><?php echo $container->State; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
