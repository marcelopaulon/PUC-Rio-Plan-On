<!-- Panel Simulações -->
   	<div class="container-fluid" style="padding-top: 70px;">
            <?php
                                    if(count($this->registry->simulacoes) > 0)
                                    {
                                        foreach($this->registry->simulacoes as $key => $simulacao)
                                        {
                                        
                                ?>
                                <div id="modalRemoveSimulacao<?php echo htmlspecialchars($simulacao->id); ?>" class="modal fade">
                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form method="post">
                                                                                <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                                <h4 class="modal-title">Remover simulação</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                                <p>Tem certeza que deseja remover esta simulação e todo o seu conteúdo?</p>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                                <a href="<?php echo __SITE_URL . '/Simulacao/Delete?id_simulacao=' . htmlspecialchars($simulacao->id); ?>" class="btn btn-primary">Remover</a>
                                                                                </div>
                                                                    </form>
                                                                </div>
                                                </div>
                                </div>
                                <?php 
                                
                                        }
                                    }
                                    ?>
            
	   	<div class="row-fluid fsi-row-md-level">
			<div class="col-md-12">
				<br>
				<div class="panel panel-default">

					<div class="panel-heading">
		   			 	<h5 class="panel-title">Minhas Simulações</h5>
		 			</div>

		 			<div class="panel-body">
		 			<br>
		 				<div class="text-center">
		 					<a class="btn btn-default btn-md" href="<?php echo __SITE_URL . '/Simulacao/Create'; ?>" role="button" style="background-color: #59ba91; color: #fff; margin-bottom: 15px;">
		 					Criar nova simulação
		 					</a>
		 				</div>

  					</div>

					<div class="table-responsive">
					<table class="table table-striped">
                                    <tr>
				        <th>Nome Simulação</th>
				        <th>Curso</th>
				        <th>Qtd períodos</th>
				        <th>Créditos obrigatórias</th>
				        <th>Créditos elet. orientação</th>
				        <th>Créditos elet. departamento</th>
				        <th>Créditos elet. fora do dep.</th>
				        <th>Créditos elet. livres</th>
				        <th>Data</th>
				        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>

                                      <!-- DADOS TABELA -->
                                      <?php
                                        if(count($this->registry->simulacoes) == 0)
                                        {
                                            echo '<tr><td>Nenhuma simulacão cadastrada. <a href="' . __SITE_URL . '/Simulacao/Create">Clique aqui</a> para adicionar uma simulação.</td></tr>';
                                        }
                                        else
                                        {
                                            foreach($this->registry->simulacoes as $key => $simulacao)
                                            {
                                                echo '<tr><td>' . htmlspecialchars($simulacao->nome) . '</td>';
                                                echo '<td>' . htmlspecialchars($simulacao->curso) . '</td>';
                                                echo '<td>' . htmlspecialchars($simulacao->qtdPeriodos) . '</td>';
                                                echo '<td>' . htmlspecialchars($simulacao->qtd_cred_disciplinas_obrigatorias . '/' . $simulacao->qtd_min_disciplinas_obrigatorias) . '</td>';
                                                echo '<td>' . htmlspecialchars($simulacao->qtd_cred_eletivas_orientacao . '/' . $simulacao->qtd_min_eletivas_orientacao) . '</td>';
                                                echo '<td>' . htmlspecialchars($simulacao->qtd_cred_eletivas_departamento . '/' . $simulacao->qtd_min_eletivas_departamento) . '</td>';
                                                echo '<td>' . htmlspecialchars($simulacao->qtd_cred_eletivas_fora_departamento . '/' . $simulacao->qtd_min_eletivas_fora_departamento) . '</td>';
                                                echo '<td>' . htmlspecialchars($simulacao->qtd_cred_eletivas_livres . '/' . $simulacao->qtd_min_eletivas_livres) . '</td>';
                                                echo '<td>' . htmlspecialchars(date('d/m/Y H:i:s', strtotime($simulacao->dataCriacao))) . '</td>';
                                                echo '<td><a class="btn btn-default btn-xs" href="' . __SITE_URL . '/Simulacao/View?id_simulacao=' . htmlspecialchars($simulacao->id) . '" role="button"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>';
                                                echo '<td><a class="btn btn-default btn-xs" href="' . __SITE_URL . '/Simulacao/Edit?id_simulacao=' . htmlspecialchars($simulacao->id) . '" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>';  
                                                echo '<td><button class="btn btn-danger btn-xs pull-left" data-toggle="modal" data-target="#modalRemoveSimulacao' . htmlspecialchars($simulacao->id) . '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td></tr>';
                                            }
                                        }
                                    ?>
 					</table>
					</div>

				</div>

				<!-- Caso seja necessária paginação

 				<div class="text-center">
 					<ul class="pagination">
  						<li><a href="#">1</a></li>
 						<li class="active"><a href="#">2</a></li>
  						<li><a href="#">3</a></li>
  						<li><a href="#">4</a></li>
  						<li><a href="#">5</a></li>
					</ul>
				</div>

				-->
                                
				<br>
			</div>
	  	</div>
  	</div>