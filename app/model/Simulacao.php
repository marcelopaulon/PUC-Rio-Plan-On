<?php

class Simulacao
{
    public $id;
    public $id_usuario;
    public $nome;
    public $curso;
    public $qtd_min_disciplinas_obrigatorias;
    public $qtd_min_eletivas_orientacao;
    public $qtd_min_eletivas_departamento;
    public $qtd_min_eletivas_fora_departamento;
    public $qtd_min_cred_eletivas_livres;
    public $qtd_cred_disciplinas_obrigatorias;
    public $qtd_cred_eletivas_orientacao;
    public $qtd_cred_eletivas_departamento;
    public $qtd_cred_eletivas_fora_departamento;
    public $qtd_cred_eletivas_livres;
    public $dataCriacao;
    
    public $qtdPeriodos;
    
    public function __construct($id, $id_usuario, $nome, $curso, $qtd_min_disciplinas_obrigatorias, $qtd_min_eletivas_orientacao, $qtd_min_eletivas_departamento, $qtd_min_eletivas_fora_departamento, $qtd_min_eletivas_livres, $dataCriacao, $qtdPeriodos = -1, $qtd_cred_disciplinas_obrigatorias = -1, $qtd_cred_eletivas_orientacao = -1, $qtd_cred_eletivas_departamento = -1, $qtd_cred_eletivas_fora_departamento = -1, $qtd_cred_eletivas_livres = -1) {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->curso = $curso;
        $this->qtd_min_disciplinas_obrigatorias = $qtd_min_disciplinas_obrigatorias;
        $this->qtd_min_eletivas_orientacao = $qtd_min_eletivas_orientacao;
        $this->qtd_min_eletivas_departamento = $qtd_min_eletivas_departamento;
        $this->qtd_min_eletivas_fora_departamento = $qtd_min_eletivas_fora_departamento;
        $this->qtd_min_eletivas_livres = $qtd_min_eletivas_livres;
        $this->qtd_cred_disciplinas_obrigatorias = $qtd_cred_disciplinas_obrigatorias;
        $this->qtd_cred_eletivas_orientacao = $qtd_cred_eletivas_orientacao;
        $this->qtd_cred_eletivas_departamento = $qtd_cred_eletivas_departamento;
        $this->qtd_cred_eletivas_fora_departamento = $qtd_cred_eletivas_fora_departamento;
        $this->qtd_cred_eletivas_livres = $qtd_cred_eletivas_livres;
        $this->dataCriacao = $dataCriacao;
        $this->qtdPeriodos = $qtdPeriodos;
    }
}