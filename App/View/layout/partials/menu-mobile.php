<div class="d-block d-sm-none">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?=BASE?>"><img src="<?=BASE?>img/logo-white.png" alt="Open Task" style="max-width: 150px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="<?=BASE?>calendar/">Calendário</a></li>
        <li class="nav-item"><a class="nav-link" href="<?=BASE?>help">Ajuda</a></li>
        <li><div class="dropdown-divider"></div></li>

        <!--ADMINISTRATOR-->
        <?php
        if($_SESSION["p"] == 1){
          ?>
          <li class="nav-item"><a class="nav-link"  href="<?=BASE?>user/">Usuário</a></li>
          <li class="nav-item"><a class="nav-link"  href="<?=BASE?>project">Projeto</a></li>
        <?php } ?>
        <li><div class="dropdown-divider"></div></li>
        <li class="nav-item"><a class="nav-link"   href="<?=BASE?>user/passwordchange">Alterar senha</a></li>
        <li class="nav-item"><a class="nav-link"   href="<?=BASE?>login/logout">Sair</a></li>
      </ul>
    </div>
  </nav>
  <br>
</div>
