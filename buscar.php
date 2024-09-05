<?php
require_once 'Contato.php';
require_once 'GerenciadorDeContatos.php';
 
session_start();
 
if (!isset($_SESSION['gerenciadorDeContatos'])) {
    $_SESSION['gerenciadorDeContatos'] = new GerenciadorDeContatos();
}
 
$gerenciadorDeContatos = $_SESSION['gerenciadorDeContatos'];
 
$resultados = [];
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['busca_nome'])) {
    $resultados = $gerenciadorDeContatos->buscaContato($_GET['busca_nome']);
}
 
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=New+Amsterdam&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Buscar Contato</title>
</head>
<body>
    <h1>Buscar Contato</h1>
 
    <div class="formulario">
        <form method="GET" action="">
            <input type="text" name="busca_nome" placeholder="Nome para Buscar" required>
            <button type="submit">Buscar Contato</button>
        </form>
    </div>
 
    <?php if (!empty($resultados)): ?>
        <h2>Resultados da Busca</h2>
        <ul>
            <?php foreach ($resultados as $contato): ?>
                <li>
                    <strong>Nome:</strong> <?= htmlspecialchars($contato->getNome()) ?><br>
                    <strong>Email:</strong> <?= htmlspecialchars($contato->getEmail()) ?><br>
                    <strong>Telefone:</strong> <?= htmlspecialchars($contato->getTelefone()) ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($_GET['busca_nome'])): ?>
        <p>Nenhum contato encontrado.</p>
    <?php endif; ?>
 
    <a href="index.php">Voltar para a Página Principal</a>
</body>
</html>