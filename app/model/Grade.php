<?php

class Grade
{
    public $id;
    public $idSimulacao;
    public $ano;
    public $semestre;
    public $dataCriacao;
    public $totalCreditos;
    
    public function __construct($id, $idSimulacao, $ano, $semestre, $dataCriacao, $totalCreditos = 0) {
        $this->id = $id;
        $this->idSimulacao = $idSimulacao;
        $this->ano = $ano;
        $this->semestre = $semestre;
        $this->dataCriacao = $dataCriacao;
        $this->totalCreditos = $totalCreditos;
    }
}