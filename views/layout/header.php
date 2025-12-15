<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adiasoft 2025</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
     <link rel="shortcut icon" href="<?=base_url?>assets/img/logo.jpg" />
</head>
<body>
    <div class="header">
        <div class="header-title">Adiasoft 2025</div>
    <!--
        <input type="text" class="search-bar" placeholder="Buscar Clientes...">
    -->
        <div class="profile">👤 Bienvenido 
            <?php $usuario = Auth::user(); ?>
            <?= $usuario ? ($usuario['username']) : 'Invitado' ?>
        </div>
    </div>

    <div class="container"> 
