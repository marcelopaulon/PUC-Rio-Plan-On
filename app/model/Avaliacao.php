<?php

class Avaliacao
{
    public $id;
    public $idUsuario;
    public $idDisciplina;
    public $dificuldadeTempo;
    public $dificuldadeConteudo;
    public $dificuldadeAvaliacao;
    public $comentario;
    public $dataCriacao;
    
    public function __construct($id, $idUsuario, $idDisciplina, $dificuldadeTempo, $dificuldadeConteudo, $dificuldadeAvaliacao, $dataCriacao, $comentario = NULL) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->idDisciplina = $idDisciplina;
        $this->dificuldadeTempo = $dificuldadeTempo;
        $this->dificuldadeConteudo = $dificuldadeConteudo;
        $this->dificuldadeAvaliacao = $dificuldadeAvaliacao;
        $this->comentario = $comentario;
        $this->dataCriacao = $dataCriacao;
    }
}