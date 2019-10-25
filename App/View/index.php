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
          <!--MAIN-->
          <div class="card border-info">
            <div class="card-header">
              Minhas tarefas
            </div>
            <div class="card-body">
              <ul class="menu-side">
                <li><a href="<?=BASE?>">Início</a></li>
                <li><a href="#">Meus projetos</a></li>
                <li><a href="#">Calendário</a></li>
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
        <?php
      }
      ?>
    </div>
    <div class="col-md-10">
      <?php $this->RunContent(); ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
