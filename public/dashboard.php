
<?php

if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid">
<span class="navbar-brand">Dashboard Seguro</span>

<a class="btn btn-danger" href="../src/Controllers/AuthController.php?action=logout">
Cerrar Sesión
</a>
</div>
</nav>

<div class="container mt-5">

<div class="alert alert-success">
Bienvenido al sistema seguro.
</div>

<div class="card">
<div class="card-body">

<h4>Integración desacoplada</h4>

<p>
Este módulo puede consumir el CRUD de instituciones mediante API REST.
</p>

</div>
</div>

</div>

</body>
</html>
