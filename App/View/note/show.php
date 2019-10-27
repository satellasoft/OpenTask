<div class="card border-info">
  <div class="card-header">
    <?=$note->title;?>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/myproject/">Projeto</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>note/">Notas</a></li>
          <li class="breadcrumb-item active">Ler Nota</li>
        </ol>
      </div>
      <div class="col-md-6">
        <?php
        if($note->userid == $_SESSION['i']){
          ?>
          <a href="<?=BASE?>note/edit/<?=$note->id;?>" class="btn btn-warning">Editar</a>
          <?php
        }
        ?>
      </div>
    </div>

    <p>Criado em: <span class="font-weight-bold"><?=convertDate($note->created);?></span>
      Por: <span class="font-weight-bold"><?=$note->username;?></span></p>

      <div class="p-3" style="background-color: #<?=$note->color;?>">
        <?=html_entity_decode($note->content);?>
      </div>

    </div>
  </div>
