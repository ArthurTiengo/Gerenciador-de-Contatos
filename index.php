<?php
require_once 'Contato.php';
require_once 'GerenciadorDeContatos.php';
 
session_start();
 
if (!isset($_SESSION['gerenciadorDeContatos'])) {
    $_SESSION['gerenciadorDeContatos'] = new GerenciadorDeContatos();
}
 
$gerenciadorDeContatos = $_SESSION['gerenciadorDeContatos'];
 
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['nome'], $_POST['email'], $_POST['telefone'])) {
        $gerenciadorDeContatos->adicionarContato($_POST['nome'], $_POST['email'], $_POST['telefone']);
    }
    if (isset($_POST['deletar'])) {
        $gerenciadorDeContatos->deletarContato($_POST['deletar']);
    }
}
 
$contatos = $gerenciadorDeContatos->getContatos();
$contatoCount = $gerenciadorDeContatos->contarContatos();
 
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
    <title>Gerenciador De Contatos</title>
</head>
<body>
<div class="container">
    <div class="titulo">
    <h1>Gerenciador De Contatos</h1>
    <div class="barra-horizontal"></div>
    </div>
    <div class="formulario">
        <form method="POST" action="">
            <div class="campo-input">
            <input type="text" name="nome" placeholder="Nome" required>
            </div>
            <div class="campo-input">
            <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="campo-input">
            <input type="text" name="telefone" placeholder="Telefone" required>
            </div>
            <div class="botao">
            <button type="submit">Adicionar Contato</button>
            <link rel="stylesheet" href="style.css">
            </div>
    </form>
    </div>
 
    <div class="links">
        <a href="atualizar.php">Atualizar Contato</a>
        <a href="buscar.php">Buscar Contato</a>
    </div>
 
    <h2>Contatos</h2>
    <ul>
        <?php foreach ($contatos as $indice => $contato): ?>
            <li>
                <strong>Nome:</strong> <?= htmlspecialchars($contato->getNome()) ?><br>
                <strong>Email:</strong> <?= htmlspecialchars($contato->getEmail()) ?><br>
                <strong>Telefone:</strong> <?= htmlspecialchars($contato->getTelefone()) ?><br>
                <form method="POST" action="" style="display:inline;">
                    <button type="submit" name="deletar" value="<?= $indice ?>">Excluir</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
 
    <h3>Total de Contatos: <?= $contatoCount ?></h3>
    </div>
</body>
</html>