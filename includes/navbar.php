<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$BASE = "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyecto SC-502</title>
  <link rel="stylesheet" href="<?= $BASE ?>/assets/css/styles.css?v=<?= time() ?>">
</head>
<body>