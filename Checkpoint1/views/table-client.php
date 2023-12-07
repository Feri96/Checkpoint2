<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,100&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,100&family=Nosifer&display=swap" rel="stylesheet">

    <title>Tabulka klientov</title>
    <?php
    require_once "..\header.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/controllers/ClientController.php";
    ?>
</head>
<body>
<?php
$clients = [];
$clientController = new ClientController();
try{
    $clients = $clientController->selectAllClients(50);
}catch(Exception $e) {
    echo $e->getMessage();
}
//var_dump($clients);
?>
<section class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">Fit club FRI
                <img src="/img/logo.png" alt="Bootstrap" width="40" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.html">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeria.html">Galeria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eshop.html">Eshop</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="prihlasenie.html">Prihlásiť</a></li>
                            <li><a class="dropdown-item" href="registracia.html">Zaregistrovať</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Hľadať" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Hľadať</button>
                    </form>
                </div>
            </nav>
        </div>
    </nav>

</section>


<div class="row">
    <div class="col-sm-2">
        <section class="sidebar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="centrum.html">Športové centrum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cennik.html">Cenník</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="treneri.html">Treneri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/views/table-client.php">Klienti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="info.html">O nas</a>
                </li>
            </ul>
        </section>
    </div>

    <div class="col-sm-10">
        <div class="center">
            <div class="container">
                <table class="table table-dark table-striped">
                    <thead>
                    <tr>
                        <th>Client Id</th>
                        <th>Meno</th>
                        <th>Priezvisko</th>
                        <th>Email</th>
                        <th>Narodenie</th>
                        <th>Mesto</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($clients as $client):
                        ?>
                        <tbody>
                        <tr>
                            <td> <?= $client->getClientId()  ?></td>
                            <td> <?= $client->getFirstName()  ?></td>
                            <td> <?= $client->getLastName() ?></td>
                            <td> <?= $client->getMail()  ?> </td>
                            <td> <?= $client->getBirthDate()  ?> </td>
                            <td> <?= $client->getCity()  ?> </td>
                            <td> <a class="btn btn-warning" href="/views/update-client-form.php?client_id=<?=$client->getClientId()?>">Update</a> </td>
                            <td> <a class="btn btn-danger" href="/servlets/delete-client.php?client_id=<?=$client->getClientId() ?>">Delete</a> </td>
                               </tr>
                        </tbody>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
            <a class="btn btn-primary" href="/views/insert-client-form.php">Pridaj</a>
        </div>
    </div>
</div>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:5,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2_5soo06q4-R3o7pHsU5tKTewtPcuEII&callback=initMap&v=weekly"
></script>

<section class="footer">
    <div class="row">
        <div class="col-sm-4">
            <h4>Adresa</h4><br><p>FRI fit-club<br><br>Vysokoškolákov <br><br> 010 01 Mesto</p>
        </div>
        <div class="col-sm-4">
            <h4>Prehľadávanie</h4>
            <ul type="none">
                <li><a href="../index.html"><p>Domov</p></a></li>
                <li><a href="eshop.html"><p>Eshop</p></a></li>
                <li><a href="napoveda.html"><p>Napoveda</p></a></li>
                <li><a href="registracia.html"><p>Registrácia</p></a></li>
                <li><a href="prihlasenie.html"><p>Prihlasenie</p></a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <h4>Kontakt</h4><br><p>Tel: +421 948 432 311 <br><br> frantisek.plutinsky@mail.com</p>
        </div>
    </div>
</section>
</body>
</html>