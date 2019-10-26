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
  <div class="p-2 mb-2 bg-primary text-white d-none d-sm-block">
    Open Task
  </div>

  <?php require_once("layout/partials/menu-mobile.php");?>

  <div class="row">
    <div class="col-md-2 d-none d-sm-block">
      <?php
      if($GLOBALS["logged"]){
        require_once("layout/partials/menu-desktop.php");
      }
      ?>
    </div>
    <div class="col-md-10 col-xs-12">
      <?php $this->RunContent(); ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
