<?php

class AvaliacoesSummary
{
    public $dificuldade_global;
    public $dificuldade_tempo;
    public $dificuldade_conteudo;
    public $dificuldade_avaliacao;
    public $avaliacoes;
    
    public function __construct($dificuldade_global, $dificuldade_tempo, $dificuldade_conteudo, $dificuldade_avaliacao, $avaliacoes) {
        $this->dificuldade_global = $dificuldade_global;
        $this->dificuldade_tempo = $dificuldade_tempo;
        $this->dificuldade_conteudo = $dificuldade_conteudo;
        $this->dificuldade_avaliacao = $dificuldade_avaliacao;
        $this->avaliacoes = $avaliacoes;
    }
}