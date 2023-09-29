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

    </style>
</head>
<body>
    <?php include 'templates/navbar.php';?>

    <div class="content">
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
                        <td><a href="container_details.php?id=<?php echo $container->Id; ?>"><?php echo $container->Names[0]; ?></a></td>
                        <td><?php echo $container->Id; ?></td>
                        <td><?php echo $container->Image; ?></td>
                        <td class="<?php echo ($container->State === 'running') ? 'running-state' : 'offline-state'; ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

