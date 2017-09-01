<?php

class Disciplina
{
    public $id;
    public $nome;
    public $qtdCreditos;
    public $tipo;
    public $reviewSummary;
    
    public function __construct($id, $nome, $qtdCreditos, $tipo = NULL, $reviewSummary = NULL) {
        $this->id = $id;
        $this->nome = $nome;
        $this->qtdCreditos = $qtdCreditos;
        $this->tipo = $tipo;
        $this->reviewSummary = $reviewSummary;
    }
}