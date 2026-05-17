<?php


$error = $_GET['error'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Verificar OTP</title>

</head>

<body>

    <h1>Verificación OTP</h1>

    <?php if ($error): ?>

        <p>
            Código inválido
        </p>

    <?php endif; ?>

    <form
        method="POST"
        action="/verify-otp"
    >

        <input
            type="text"
            name="otp"
            placeholder="Ingrese OTP"
            required
        >

        <button type="submit">
            Verificar
        </button>

    </form>

</body>
</html>
