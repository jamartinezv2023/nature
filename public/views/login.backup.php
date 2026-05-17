<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Login</title>


<link rel="stylesheet" href="/public/assets/css/style.css">
</head>

<body>

    <h1>Iniciar Sesión</h1>

    <form
        method="POST"
        action="/login"
    >

        <input
            type="email"
            name="email"
            placeholder="Correo"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Contraseña"
            required
        >

        <button type="submit">
            Ingresar
        </button>

    </form>

</body>
</html>
