
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid" style="background-color: #605e5e;">

            <div class="navbar-header">
	      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Navegar no site</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      	</button>
                <a class="navbar-brand" style="color: #fff; padding-top: 0px;" href="<?php echo __SITE_URL; ?>"><img src="<?php echo __SITE_URL; ?>/style/planon_logo_white.png" style="padding: 5px; height: 45px; margin-top: 2px;"/></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                   <ul class="nav navbar-nav">
                           <li<?php if($this->registry->action != "About") { ?> class="active" <?php } ?>><a style="color: #fff; <?php if($this->registry->action != "About") { ?> background-color: #59ba91; <?php } ?>" href="<?php echo __SITE_URL; ?>">Simulações<?php if($this->registry->action != "About") { ?> <span class="sr-only">(atual)</span> <?php } ?></a></li>
                           <li<?php if($this->registry->action == "About") { ?> class="active" <?php } ?>><a style="color: #fff; <?php if($this->registry->action == "About") { ?> background-color: #59ba91; <?php } ?>" href="<?php echo __SITE_URL; ?>/Home/About">Sobre<?php if($this->registry->action == "About") { ?> <span class="sr-only">(atual)</span> <?php } ?></a></li>
                   </ul>

                   <ul class="nav navbar-nav navbar-right">
                           <li><a style="color: #fff" href="#"><?php echo $this->registry->user->nome; ?></a></li>
                           <li><a style="color: #fff" href="<?php echo __SITE_URL; ?>/Logout">Sair</a></li>
                   </ul>
            </div>
	  </div>
	</nav>

