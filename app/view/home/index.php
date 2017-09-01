<div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Cadastre-se</a></li>
        <li class="tab"><a href="#login">Entrar</a></li>
      </ul>
    
      <?php if($this->registry->errorMessage != NULL && strlen($this->registry->errorMessage) > 0) { ?>
      
      <div class="errorMessage"><?php echo $this->registry->errorMessage; ?></div>
      
      <?php } ?>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Faça sua conta no Plan-On</h1>
          
          <form method="post">
            <input type="hidden" name="register" value="1" />
            <div class="field-wrap">
              <label>
                Nome<span class="req">*</span>
              </label>
              <input type="text" name="name" required autocomplete="off" />
            </div>
              
          <div class="field-wrap">
            <label>
              Endereço de e-mail<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Senha<span class="req">*</span>
            </label>
            <input type="password" name="password"  required autocomplete="off"/>
          </div>
          
          <button type="submit" class="button button-block"/>Começar</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Olá!</h1>
          
          <form method="post">
            <input type="hidden" name="login" value="1" />
            <div class="field-wrap">
            <label>
              Endereço de e-mail<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Senha<span class="req">*</span>
            </label>
              <input type="password" name="password" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#" onclick="alert('Que pena! ¯\\_(ツ)_/¯ Ainda estamos implementando esta funcionalidade. Entre em contato conosco se precisar de mais informações');">Esqueceu sua senha?</a></p>
          
          <button class="button button-block"/>Entrar</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<link rel='stylesheet' id='login-css'  href='<?php echo __SITE_URL; ?>/style/login.css' type='text/css' media='all' />
<script type="text/javascript" src="<?php echo __SITE_URL; ?>/scripts/login.js"></script>