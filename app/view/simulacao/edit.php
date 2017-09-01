 	<!-- Grid Nova Simulação -->
   	<div class="container-fluid" style="padding-top: 70px;">
	   	<div class="row-fluid fsi-row-md-level">
			<div class="col-md-12">
				<br>
				<!-- Panel Nova Simulação -->
				<div class="panel panel-default">

					<div class="panel-heading">
		   			 	<h5 class="panel-title">Nova Simulação</h5>
		 			</div>

		 			<div class="panel-body">

        <form method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Nome da simulação</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($this->registry->simulacao->nome); ?>">
                
              </div>
              <div class="form-group">
                    <label for="exampleInputEmail1">Curso</label>
                    <input type="text" class="form-control" name="curso" placeholder="Curso" value="<?php echo htmlspecialchars($this->registry->simulacao->curso); ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Mínimo de créditos disciplinas obrigatórias</label>
                <input type="text" class="form-control" name="minObrig" placeholder="Quantidade de créditos" value="<?php echo htmlspecialchars($this->registry->simulacao->qtd_min_disciplinas_obrigatorias); ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Mínimo de créditos disciplinas eletivas de orientação</label> <!-- mudar para dropdown -->
                <input type="text" class="form-control" name="minOrient" placeholder="Quantidade de créditos" value="<?php echo htmlspecialchars($this->registry->simulacao->qtd_min_eletivas_orientacao); ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Mínimo de créditos disciplinas eletivas do departamento</label> <!-- mudar para dropdown -->
                <input type="text" class="form-control" name="minDep" placeholder="Quantidade de créditos" value="<?php echo htmlspecialchars($this->registry->simulacao->qtd_min_eletivas_departamento); ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Mínimo de créditos disciplinas eletivas fora do departamento</label> <!-- mudar para dropdown -->
                <input type="text" class="form-control" name="minForaDep" placeholder="Quantidade de créditos" value="<?php echo htmlspecialchars($this->registry->simulacao->qtd_min_eletivas_fora_departamento); ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Mínimo de créditos disciplinas eletivas livres</label> <!-- mudar para dropdown -->
                <input type="text" class="form-control" name="minLivres" placeholder="Quantidade de créditos" value="<?php echo htmlspecialchars($this->registry->simulacao->qtd_min_eletivas_livres); ?>">
              </div>

                <div class="text-center">
                        <a class="btn btn-default btn-md" href="index.html" role="button" style="background-color: #d11054; color: #fff; margin-top: 30px;">
                        Cancelar
                        </a>
                        <!-- VOLTAR AQUI -->
                        <!-- Verificar se todos os campos foram preenchidos para prosseguir -->
                        <input class="btn btn-submit btn-md" type="submit" value="Salvar" style="background-color: #59ba91; color: #fff; margin-top: 30px;" />
                </div>
            </form>

  					</div>


				</div>

			</div>
			<!-- FIM Panel Nova Simulação -->
	  	</div>
  	</div>
