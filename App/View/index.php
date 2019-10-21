<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="<?=BASE?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=BASE?>css/style.css">
  <link rel="shortcut icon" href="<?=BASE?>img/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="<?=BASE?>js/global.js"></script>
  <?php $this->RunHeader(); ?>
</head>
<body>
  <div class="p-2 mb-2 bg-primary text-white">
    Open Task
  </div>
  <div class="row">
    <div class="col-md-2">
      <?php
      if($GLOBALS["logged"]){
        ?>
        <div class="p-1">
          <!--ADMINISTRATOR-->
          <div class="card border-info">
            <div class="card-header">
              Minhas tarefas
            </div>
            <div class="card-body">
              <ul class="menu-side">
                <li><a href="<?=BASE?>">Início</a></li>
                <li><a href="#">Meus projetos</a></li>
                <li><a href="#">Calendário</a></li>
                <li><a href="<?=BASE?>login/logout">Sair</a></li>
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
                <li><a href="<?=BASE?>project/">Projeto</a></li>
              </ul>
            </div>
          </div>
        <?php } ?>
        </div>
        <?php
      }
      ?>
    </div>
    <div class="col-md-10">
      <?php $this->RunContent(); ?>
    </div>
  </div>
</body>
</html>
