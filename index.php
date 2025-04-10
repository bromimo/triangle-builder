<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Построение равнобедренного треугольника</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20px;
        }

        pre {
            font-family: "Courier New", Courier, monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
            text-align: center;
            margin: 20px auto;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .triangle {
            white-space: pre;
            font-family: monospace;
            font-size: 16px;
            line-height: 1.5;
            margin-top: 20px;
        }

        input[type="number"] {
            padding: 5px;
            font-size: 16px;
        }

        button {
            padding: 6px 12px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Построение равнобедренного треугольника</h1>

<div class="form-container">
    <form method="POST" action="index.php">
        <label for="n">Введите количество элементов: </label>
        <input type="number" id="n" name="n" min="1" required>
        <button type="submit">Построить</button>
    </form>
</div>

<?php
require_once 'autoload.php';

use TriangleBuilder\TriangleBuilder;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['n']) && is_numeric($_POST['n'])) {
    $n = intval($_POST['n']);
    echo '<pre>';
    TriangleBuilder::make($n)->forWeb()->build();
    echo '</pre>';
}
?>

</body>
</html>