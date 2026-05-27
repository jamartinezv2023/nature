<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Verificación OTP</title>

<style>

body{
    font-family:Arial, sans-serif;
    background:#f5f7fb;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    width:420px;
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 10px 40px rgba(0,0,0,.08);
}

h1{
    color:#2563eb;
}

input{
    width:100%;
    padding:16px;
    font-size:22px;
    text-align:center;
    margin-top:20px;
    margin-bottom:20px;
}

button{
    width:100%;
    padding:16px;
    background:#e6005c;
    color:white;
    border:none;
    border-radius:10px;
    font-size:18px;
    cursor:pointer;
}

</style>

</head>

<body>

<div class="card">

<h1>Ecosistema Nature</h1>

<p>Ingrese el OTP</p>

<form action="/verify-otp-submit" method="POST">

<input
type="text"
name="otp"
maxlength="6"
required
/>

<button type="submit">
Verificar y Acceder
</button>

</form>

</div>

</body>
</html>
