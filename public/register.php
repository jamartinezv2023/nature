
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h3>Registro</h3>
</div>

<div class="card-body">

<form action="../src/Controllers/AuthController.php?action=register" method="POST">

<input class="form-control mb-3" name="nombre" placeholder="Nombre">

<input class="form-control mb-3" name="email" placeholder="Email">

<input class="form-control mb-3" name="telefono" placeholder="Teléfono">

<input class="form-control mb-3" type="password" name="password" placeholder="Contraseña">

<button class="btn btn-success w-100">
Crear Cuenta
</button>

</form>

</div>

</div>

</div>

</body>
</html>
