<div class="p-1">
  <!--MAIN-->
  <div class="card border-info">
    <div class="card-header">
      Minhas tarefas
    </div>
    <div class="card-body">
      <ul class="menu-side">
        <li><a href="<?=BASE?>">Início</a></li>
        <li><a href="#">Meus projetos</a></li>
        <li><a href="<?=BASE?>calendar/">Calendário</a></li>
        <li><a href="<?=BASE?>help">Ajuda</a></li>
      </ul>
    </div>
  </div>

  <!--ADMINISTRATOR-->
  <?php
  if($_SESSION["p"] == 1){
   ?>
  <div class="card border-info mt-3">
    <div class="card-header">
      Administrator
    </div>
    <div class="card-body">
      <ul class="menu-side">
        <li><a href="<?=BASE?>user/">Usuário</a></li>
        <li><a href="<?=BASE?>project">Projeto</a></li>
      </ul>
    </div>
  </div>
<?php } ?>


<!--ADMINISTRATOR-->
<div class="card border-info mt-3">
  <div class="card-header">
    Configurações
  </div>
  <div class="card-body">
    <ul class="menu-side">
      <li><a href="<?=BASE?>user/passwordchange">Alterar senha</a></li>
      <li><a href="<?=BASE?>login/logout">Sair</a></li>
    </ul>
  </div>
</div>
</div>
