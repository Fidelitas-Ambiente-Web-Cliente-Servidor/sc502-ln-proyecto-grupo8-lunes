<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$BASE = dirname($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyecto SC-502</title>

  <link rel="stylesheet" href="<?= $BASE ?>/assets/css/styles.css?v=<?= time() ?>">

  <style>
    .alert {
      margin-top: 10px;
      padding: 10px 14px;
      border-radius: 8px;
      font-size: 0.9rem;
    }

    .alert-success {
      background: #d1fae5;
      color: #065f46;
    }

    .alert-error {
      background: #fee2e2;
      color: #991b1b;
    }
  </style>
</head>

<body>