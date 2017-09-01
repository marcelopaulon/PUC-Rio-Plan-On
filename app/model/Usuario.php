<?php

class Usuario
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $codSessao;
    public $dataCriacao;
    
    public function __construct($id, $nome, $email, $senha, $codSessao, $dataCriacao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->codSessao = $codSessao;
        $this->dataCriacao = $dataCriacao;
    }
}