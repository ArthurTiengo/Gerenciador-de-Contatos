<?php
require_once 'Contato.php';
 
class GerenciadorDeContatos {
    private $contatos = [];
 
    public function adicionarContato($nome, $email, $telefone) {
        $contato = new Contato($nome, $email, $telefone);
        $this->contatos[] = $contato;
    }
 
    public function getContatos() {
        return $this->contatos;
    }
 
    public function deletarContato($indice) {
        if (isset($this->contatos[$indice])) {
            array_splice($this->contatos, $indice, 1);
        }
    }
 
    public function atualizarContato($telefone, $novoNome, $novoEmail, $novoTelefone) {
        foreach ($this->contatos as $indice => $contato) {
            if ($contato->getTelefone() === $telefone) {
                $this->contatos[$indice] = new Contato($novoNome, $novoEmail, $novoTelefone);
                return;
            }
        }
    }
 
    public function buscaContato($nome) {
        $resultados = [];
        foreach ($this->contatos as $indice => $contato) {
            if (stripos($contato->getNome(), $nome) !== false) {
                $resultados[$indice] = $contato;
            }
        }
        return $resultados;
    }
 
    public function contarContatos() {
        return count($this->contatos);
    }
}
?>