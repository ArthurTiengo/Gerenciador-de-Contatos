<?php
require_once 'Contato.php';
require_once 'GerenciadorDeContatos.php';
 
session_start();
 
if (!isset($_SESSION['gerenciadorDeContatos'])) {
    $_SESSION['gerenciadorDeContatos'] = new GerenciadorDeContatos();
}
 
$gerenciadorDeContatos = $_SESSION['gerenciadorDeContatos'];
 
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['atualizar'], $_POST['telefone'], $_POST['novo_nome'], $_POST['novo_email'], $_POST['novo_telefone'])) {
    $gerenciadorDeContatos->atualizarContato($_POST['telefone'], $_POST['novo_nome'], $_POST['novo_email'], $_POST['novo_telefone']);
}
 
$contatos = $gerenciadorDeContatos->getContatos();
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
    <title>Atualizar Contato</title>
</head>
<body>
    <h1>Atualizar Contato</h1>
 
    <div class="formulario">
        <form method="POST" action="">
            <label for="telefone_atualizacao">Selecione o Contato para Atualizar:</label>
            <select name="telefone" id="telefone_atualizacao" required>
                <?php foreach ($contatos as $contato): ?>
                    <option value="<?= htmlspecialchars($contato->getTelefone()) ?>">
                        <?= htmlspecialchars($contato->getNome()) ?> (<?= htmlspecialchars($contato->getTelefone()) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="novo_nome" placeholder="Novo Nome" required>
            <input type="email" name="novo_email" placeholder="Novo Email" required>
            <input type="text" name="novo_telefone" placeholder="Novo Telefone" required>
            <button type="submit" name="atualizar">Atualizar Contato</button>
        </form>
    </div>
 
    <a href="index.php">Voltar para a Página Principal</a>
</body>
</html>