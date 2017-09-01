 	<!-- Grid Editar grade -->
   	<div class="container-fluid" style="padding-top: 70px;">
	   	<div class="row-fluid fsi-row-md-level">
			<div class="col-md-12">
				<br>
				<!-- Panel Editar grade -->
				<div class="panel panel-default">

					<div class="panel-heading">
		   			 	<h5 class="panel-title">Editar grade</h5>
		 			</div>

		 			<div class="panel-body">
          <form method="post">
              <div class="form-group">
                <label>Ano da Grade</label>
                <input type="number" class="form-control" name="ano" placeholder="Ano"  min="1990" max="2050" value="<?php echo htmlspecialchars($this->registry->grade->ano); ?>" />
              </div>
              <div class="form-group">
                <label>Semestre da Grade</label>
                <input type="number" class="form-control" name="semestre" placeholder="Semestre" min="1" max="2" value="<?php echo htmlspecialchars($this->registry->grade->semestre); ?>" />
              </div>
              
              <button type="submit" class="btn btn-default">Salvar grade</button>
          </form>

  					</div>


				</div>

			</div>
			<!-- FIM Panel Editar Grade -->
	  	</div>
  	</div>

