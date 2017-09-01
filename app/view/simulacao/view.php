<?php
function getDificuldadeTxt($dificuldade, $avalie = false)
{
    switch(intval($dificuldade))
    {
        case 1:
            return 'Muito fácil';
        case 2:
            return 'Fácil';
        case 3:
            return 'Médio';
        case 4:
            return 'Difícil';
        case 5:
            return 'Muito difícil';
    }
    
    if(!$avalie)
    {
        return '-';
    }
    
    return 'Avalie';
}
?>
<style>
    legend
    {
        font-size: 18px;
        font-weight: bold;
    }
    
    .hideOverflow
    {
        text-overflow:ellipsis;
    }
</style>
        <div id="ErrorModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="color: red"></span> Erro</h4>
                    </div>
                    <div class="modal-body" id="ErrorMessage">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Nome Simulação -->
   	<div class="container-fluid" style="padding-top: 70px;">
	   	<div class="row-fluid fsi-row-md-level">
				<div class="col-md-12">
					<br>
					<div class="panel panel-default">
						<!-- PANEL HEADING -->
						<div class="panel-heading">
							<!-- VOLTAR AQUI -->
								<h5 class="panel-title pull-left">
									<?php echo htmlspecialchars($this->registry->simulacao->nome); ?>
								</h5>

								<a class="btn btn-default btn-xs pull-right" href="<?php echo __SITE_URL . '/Simulacao/Edit?id_simulacao=' . htmlspecialchars($this->registry->simulacao->id); ?>" role="button">
										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>

								<div class="clearfix"></div>

			 			</div>
						<!-- FIM PANEL HEADING -->

						<!-- PANEL BODY -->
			 			<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped">
									<tr>
										<th>Curso</th>
                                                                                <th>Qtd períodos</th>
                                                                                <th>Créditos obrigatórias</th>
                                                                                <th>Créditos elet. orientação</th>
                                                                                <th>Créditos elet. departamento</th>
                                                                                <th>Créditos elet. fora do dep.</th>
                                                                                <th>Créditos elet. livres</th>
									</tr>

									<tr>
										<th><?php echo htmlspecialchars($this->registry->simulacao->curso); ?></th>
                                                                                <th><?php echo $this->registry->simulacao->qtdPeriodos; ?></th>
						        <th><?php echo htmlspecialchars($this->registry->simulacao->qtd_cred_disciplinas_obrigatorias . '/' . $this->registry->simulacao->qtd_min_disciplinas_obrigatorias); ?></th>
						        <th><?php echo htmlspecialchars($this->registry->simulacao->qtd_cred_eletivas_orientacao . '/' . $this->registry->simulacao->qtd_min_eletivas_orientacao); ?></th>
						        <th><?php echo htmlspecialchars($this->registry->simulacao->qtd_cred_eletivas_departamento . '/' . $this->registry->simulacao->qtd_min_eletivas_departamento); ?></th>
						        <th><?php echo htmlspecialchars($this->registry->simulacao->qtd_cred_eletivas_fora_departamento . '/' . $this->registry->simulacao->qtd_min_eletivas_fora_departamento); ?></th>
							<th><?php echo htmlspecialchars($this->registry->simulacao->qtd_cred_eletivas_livres . '/' . $this->registry->simulacao->qtd_min_eletivas_livres); ?></th>
						        		</tr>
								</table>
							</div>
						</div>
						<!-- FIM PANEL BODY -->

					</div>
	  		</div>
  		</div>
		</div>
		<!-- FIM Panel Nome Simulação -->

		<!-- Grid Grades/Disciplinas -->
   	<div class="container-fluid">
	   	<div class="row-fluid fsi-row-md-level">

				<!-- Panel Grades -->
				<div class="col-md-8">
                                    <div class="panel panel-default" style="min-height:250px;">
						<!-- PANEL HEADING -->
						<div class="panel-heading">
								<h5 class="panel-title pull-left">
									Grades
								</h5>

								<a class="btn btn-default btn-md pull-right" href="<?php echo __SITE_URL . '/Grade/Create?id_simulacao=' . htmlspecialchars($this->registry->simulacao->id); ?>" role="button" style="background-color: #59ba91; color: #fff;">
										Adicionar grade
								</a>

								<div class="clearfix"></div>

			 			</div>
						<!-- FIM PANEL HEADING -->

						<!-- PANEL BODY -->
			 			<div class="panel-body">
							<div class="row-fluid fsi-row-md-level">

								<?php
                                                                if(count($this->registry->grades) == 0)
                                                                {
                                                                    echo '<h3>Nenhuma grade cadastrada.</h3>';
                                                                }
                                                                ?>
                                                            
                                                                <?php
                                                                foreach($this->registry->grades as $grade)
                                                                {
                                                                ?>
                                                            
								<div class="col-md-11 col-md-offset-1 gradePanelContainer" data-grade-id="<?php echo htmlspecialchars($grade[0]->id); ?>" ondrop="SimulacaoView.drop(event)" ondragover="SimulacaoView.onDragOver(event)">
									<!-- Panel período -->
									<div class="panel panel-default">

										<!-- PANEL HEADING -->
										<div class="panel-heading">
											<h5 class="panel-title pull-left">
												<?php echo htmlspecialchars($grade[0]->ano . '.' . $grade[0]->semestre) . ' - ' . $grade[0]->totalCreditos . ' créditos'; ?>
											</h5>
											<!-- Deletar grade -->
											<button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#modalRemoveGrade<?php echo htmlspecialchars($grade[0]->id); ?>" style="background-color: #d11054; color:#fff;">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
											</button>

											<div id="modalRemoveGrade<?php echo htmlspecialchars($grade[0]->id); ?>" class="modal fade">
													<div class="modal-dialog">
															<div class="modal-content">
                                                                                                                            <form method="post">
																	<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title">Remover grade</h4>
																	</div>
																	<div class="modal-body">
																			<p>Tem certeza que deseja remover esta grade e desassociar todas as suas disciplinas e seus pré-requisitos?</p>

																	</div>
																	<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                                                                                        <input type="hidden" name="remove_grade" value="true" />
                                                                                                                                                        <input type="hidden" name="id_grade_remove" value="<?php echo htmlspecialchars($grade[0]->id); ?>" />
                                                                                                                                                        <input type="submit" value="Remover" class="btn btn-primary" />
																	</div>
                                                                                                                            </form>
															</div>
													</div>
											</div>

											<!---<a class="btn btn-default btn-xs pull-right" href="<?php echo __SITE_URL . '/Grade/Edit?id_grade=' . htmlspecialchars($grade[0]->id); ?>" role="button" style="margin-right:1em">
											TODO 2017: TRATAR AS MUDANÇAS DE GRADE		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>-->

											<div class="clearfix"></div>
										</div>
										<!-- FIM PANEL HEADING -->

										<!-- PANEL BODY -->
							 			<div class="panel-body">
                                                                                <?php if(count($grade[1]) == 0)
                                                                                            {
                                                                                                echo '<h3>Não há disciplinas cadastradas</h3>';
                                                                                            }
                                                                                            else
                                                                                            {

                                                                                ?>
											<div class="table-responsive">
												<table class="table table-striped">
													<tr>
														<th>Código</th>
														<th>Nome</th>
														<th>Créditos</th>
														<th>Dificuldade</th>
														<th>Tipo</th>
														<th></th>
													</tr>
                                                                                                        <?php
                                                                              foreach($grade[1] as $key => $disciplina)
                                                                              {
                                                                                  $tipo = "-";
                                                                                    switch($disciplina->tipo)
                                                                                    {
                                                                                        case 'R':
                                                                                            $tipo = "Obrigatória";
                                                                                            break;
                                                                                        case 'D':
                                                                                            $tipo = "Eletiva do dep.";
                                                                                            break;
                                                                                        case 'F':
                                                                                            $tipo = "Eletiva fora do dep.";
                                                                                            break;
                                                                                        case 'L':
                                                                                            $tipo = "Eletiva livre";
                                                                                            break;
                                                                                        case 'O':
                                                                                            $tipo = "Eletiva de orientação";
                                                                                            break;
                                                                                    }
                                                                        ?>
													<tr>
														<th><?php echo htmlspecialchars($disciplina->id); ?></th>
                                                                                                                <th><?php echo htmlspecialchars($disciplina->nome); ?></th>
                                                                                                                <th><?php echo htmlspecialchars($disciplina->qtdCreditos); ?> créditos</th>
														<td>
															<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDificuldade<?php echo htmlspecialchars($disciplina->id); ?>" data-codDisciplina="<?php echo htmlspecialchars($disciplina->id); ?>"><?php echo getDificuldadeTxt($disciplina->reviewSummary->dificuldade_global, true); ?></button>
                                                                                                                        
                                                                                                                        <div id="modalDificuldade<?php echo htmlspecialchars($disciplina->id); ?>" class="modal fade" style="z-index:1042;">
                                                                                                                            <div class="modal-dialog">
                                                                                                                                <div class="modal-content">
                                                                                                                                    <div class="modal-header">
                                                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                                                                    </div>
                                                                                                                                    <div class="modal-body">
                                                                                                                                        <legend>Avaliação - <?php echo htmlspecialchars($disciplina->nome); ?></legend>
                                                                                                                                        
                                                                                                                                            <input type="hidden" name="cod_disciplina" value="<?php echo htmlspecialchars($disciplina->id); ?>" />
                                                                                                                                            <div style="border: 1px solid #ccc; padding: 5px;">
                                                                                                                                                <div class="row">
                                                                                                                                                    <div class="col-md-4">
                                                                                                                                                        <p>Tempo:</p>
                                                                                                                                                        <input type="radio" name="tempo" value="1" checked> Muito fácil<br />
                                                                                                                                                        <input type="radio" name="tempo" value="2"> Fácil<br />
                                                                                                                                                        <input type="radio" name="tempo" value="3"> Médio<br />
                                                                                                                                                        <input type="radio" name="tempo" value="4"> Dificil<br />
                                                                                                                                                        <input type="radio" name="tempo" value="5"> Muito difícil
                                                                                                                                                    </div>
                                                                                                                                                    <div class="col-md-4">
                                                                                                                                                        <p>Conteúdo:</p>
                                                                                                                                                        <input type="radio" name="conteudo" value="1" checked> Muito fácil<br />
                                                                                                                                                        <input type="radio" name="conteudo" value="2"> Fácil<br />
                                                                                                                                                        <input type="radio" name="conteudo" value="3"> Médio<br />
                                                                                                                                                        <input type="radio" name="conteudo" value="4"> Dificil<br />
                                                                                                                                                        <input type="radio" name="conteudo" value="5"> Muito difícil
                                                                                                                                                    </div>
                                                                                                                                                    <div class="col-md-4">
                                                                                                                                                        <p>Provas/Trabalhos:</p>
                                                                                                                                                        <input type="radio" name="avaliacao" value="1" checked> Muito fácil<br />
                                                                                                                                                        <input type="radio" name="avaliacao" value="2"> Fácil<br />
                                                                                                                                                        <input type="radio" name="avaliacao" value="3"> Médio<br />
                                                                                                                                                        <input type="radio" name="avaliacao" value="4"> Dificil<br />
                                                                                                                                                        <input type="radio" name="avaliacao" value="5"> Muito difícil
                                                                                                                                                    </div>
                                                                                                                                                  </div>
                                                                                                                                                <br />
                                                                                                                                                <div>
                                                                                                                                                    <p>Comentário</p>
                                                                                                                                                    <textarea class="form-control" name="comment" rows="3"></textarea>
                                                                                                                                                </div>
                                                                                                                                                <br />
                                                                                                                                                <div>
                                                                                                                                                    <button type="submit" class="btn" data-idusuario="<?php echo $this->registry->user->id; ?>" data-coddisciplina="<?php echo htmlspecialchars($disciplina->id); ?>" onclick="SimulacaoView.SendAvaliacao(this)">Enviar avaliação</button>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                        
                                                                                                                                        <br />
                                                                                                                                        <legend>Dificuldade da disciplina</legend>
                                                                                                                                        <div style="border: 1px solid #ccc; padding: 5px;">
                                                                                                                                            <dl class="dl-horizontal">
                                                                                                                                            <dt>Tempo:</dt> <dd><?php echo getDificuldadeTxt($disciplina->reviewSummary->dificuldade_tempo); ?></dd><br />
                                                                                                                                            <dt>Conteúdo:</dt> <dd><?php echo getDificuldadeTxt($disciplina->reviewSummary->dificuldade_conteudo); ?></dd><br />
                                                                                                                                            <dt>Provas/Trabalhos:</dt> <dd><?php echo getDificuldadeTxt($disciplina->reviewSummary->dificuldade_avaliacao); ?></dd>
                                                                                                                                            </dl>
                                                                                                                                        </div>
                                                                                                                                        <?php 
                                                                                                                                        if(!$disciplina->reviewSummary->avaliacoes || count($disciplina->reviewSummary->avaliacoes) == 0)
                                                                                                                                        {
                                                                                                                                            echo '<br /><p>Nenhum usuário avaliou esta disciplina ainda. Seja o primeiro!</p>';  
                                                                                                                                        }
                                                                                                                                        else
                                                                                                                                        {
                                                                                                                                            echo '<br /><legend>Avaliações de outros usuários:</legend>';
                                                                                                                                            $i = 0;
                                                                                                                                            foreach($disciplina->reviewSummary->avaliacoes as $key => $avaliacao) { $i++; if($i == 5) { break; } ?>
                                                                                                                                                <div style="border: 1px solid #ccc; padding: 5px;">
                                                                                                                                                    <dl class="dl-horizontal">
                                                                                                                                                        <dt>Tempo:</dt> 
                                                                                                                                                        <dd><?php echo getDificuldadeTxt($avaliacao->dificuldadeTempo); ?> </dd>
                                                                                                                                                        <br /> 
                                                                                                                                                        <dt>Conteúdo:</dt> 
                                                                                                                                                        <dd><?php echo getDificuldadeTxt($avaliacao->dificuldadeConteudo); ?> </dd>
                                                                                                                                                        <br /> 
                                                                                                                                                        <dt>Provas/Trabalhos:</dt> 
                                                                                                                                                        <dd><?php echo getDificuldadeTxt($avaliacao->dificuldadeAvaliacao); ?></dd>
                                                                                                                                                    </dl>
                                                                                                                                                    <blockquote class="hideOverflow">“<?php echo htmlspecialchars($avaliacao->comentario); ?>”</blockquote>
                                                                                                                                                </div>
                                                                                                                                        <?php } } ?>
                                                                                                                                        
                                                                                                                                        <br />
                                                                                                                                        
                                                                                                                                    </div>
                                                                                                                                    <div class="modal-footer">
                                                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                </td>
														<th>
                                                                                                                    <select class="btn btn-mini" data-coddisciplina="<?php echo htmlspecialchars($disciplina->id); ?>" data-idgrade="<?php echo htmlspecialchars($grade[0]->id); ?>" onchange="SimulacaoView.ChangeType(this)">
																<option>Escolher tipo</option>
																<option value="R"<?php if($disciplina->tipo == 'R') echo ' selected="selected"'?>>Obrigatória</option>
																<option value="O"<?php if($disciplina->tipo == 'O') echo ' selected="selected"'?>>Orientação</option>
                                                                                                                                <option value="F"<?php if($disciplina->tipo == 'F') echo ' selected="selected"'?>>Fora do departamento</option>
                                                                                                                                <option value="L"<?php if($disciplina->tipo == 'L') echo ' selected="selected"'?>>Livre</option>
                                                                                                                                <option value="D"<?php if($disciplina->tipo == 'D') echo ' selected="selected"'?>>Do departamento</option>
															</select>
														</th>
														<th>
															<a class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#modalRemoveDisciplina<?php echo htmlspecialchars($disciplina->id); ?>" role="button" style="background-color: #d11054; color:#fff;">
																	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
															</a>

															<div id="modalRemoveDisciplina<?php echo htmlspecialchars($disciplina->id); ?>" class="modal fade">
																	<div class="modal-dialog">
                                                                                                                                            <form method="post">
																			<div class="modal-content">
																					<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																							<h4 class="modal-title">Remover disciplina</h4>
																					</div>
																					<div class="modal-body">
																							<p>Tem certeza que deseja remover esta disciplina e todos os seus pré-requisitos desta simulação?</p>

																					</div>
																					<div class="modal-footer">
																							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                                                                                                                        <input type="hidden" name="remove_disciplina" value="true" />
                                                                                                                                                                                        <input type="hidden" name="cod_disciplina_remove" value="<?php echo htmlspecialchars($disciplina->id); ?>" />
                                                                                                                                                                                        <input type="hidden" name="id_grade_remove" value="<?php echo htmlspecialchars($grade[0]->id); ?>" />
																							<input class="btn btn-primary" type="submit" value="Remover" />
																					</div>
																			</div>
                                                                                                                                            </form>
																	</div>
															</div>
														</th>
													</tr>
                                                                                                    <?php                              
                                                                                                        }
                                                                                                    ?>
												</table>

													<div class="row-fluid fsi-row-md-level">
														<div class="col-md-12" style="background-color: #f7f3b2;">
															<div class="text-left" style="padding-top:10px;">
																<!-- VOLTAR AQUI -->
																<!-- Cálculo da dificuldade -->
																<p> <b>Dificuldade do período:</b> <?php echo getDificuldadeTxt($disciplina->reviewSummary->dificuldade_global, false); ?> <br>
																<small>* A dificuldade de um período é calculada através da média das dificuldades das disciplinas que ele possui.</small></p>
															</div>
														</div>
													</div>

											</div>
                                                                                    <?php 
                                                                                      }
                                                                                    ?>
										</div>
											<!-- FIM PANEL BODY -->

									</div>
									<!-- FIM Panel período -->

								</div>
								<!-- FIM período -->
                                                                <?php
                                                                }
                                                                ?>
							</div>

						</div>
						<!-- FIM PANEL BODY -->

					</div>
                                </div>
				<!-- FIM Panel Grades -->

				<!-- Panel Disciplinas -->
				<div class="col-md-4" style="position: fixed; overflow-y:auto; right: 0; margin-right: 30px; height: 60%;">
					<div class="panel panel-default">
						<!-- PANEL HEADING -->
						<div class="panel-heading">
								<h5 class="panel-title">
									Disciplinas
								</h5>
								<br>
                                                                <input type="text" class="input-xxlarge input-block-level search-query" id="txtSearch" />
                                                                <button type="submit" class="btn" id="btnSearch">Buscar</button>

								<div class="clearfix"></div>

			 			</div>
						<!-- FIM PANEL HEADING -->

						<!-- PANEL BODY -->
			 			<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped" id="searchTableResult">
									<tr>
                                                                            <td>Digite o código/nome da disciplina e clique em Buscar<td>
									</tr>
								</table>
							</div>
                                                    <h6> Até 10 disciplinas exibidas. Refine a pesquisa caso não encontre a disciplina desejada. </h6>
						</div>
						<!-- FIM PANEL BODY -->

					</div>
	  		</div>
				<!-- FIM Panel Disciplinas -->

  		</div>

		</div>
		<!-- FIM Grid Grades/Disciplinas -->

		<div class="container-fluid" style="background-color: #edeaea;">
			<div class="row-fluid fsi-row-md-level">
				<div class="col-md-2 col-md-offset-5">
					<div class="text-center">
						<!-- VOLTAR AQUI -->
						<a class="btn btn-block btn-md" href="#" onclick="window.print()" style="background-color: #605e5e; color: #fff; margin-bottom: 20px; margin-top: 20px;">
						Imprimir
						</a>
					</div>
				</div>
			</div>
		</div>
                
                <script type="text/javascript" src="<?php echo __SITE_URL; ?>/scripts/simulacaoview.javascript.js"></script>