
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Verificar OTP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">
<h3>Doble Factor</h3>
</div>

<div class="card-body">

<form action="../src/Controllers/AuthController.php?action=verify-otp" method="POST">

<label>Código OTP</label>

<input type="text" class="form-control mb-3" name="otp">

<button class="btn btn-warning w-100">
Validar Código
</button>

</form>

</div>

</div>

</div>

</body>
</html>
