<div class="card border-info">
  <div class="card-header">
    Lista de notas
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/myproject/">Projeto</a></li>
          <li class="breadcrumb-item active">Lista de Nota</li>
        </ol>
      </div>
    </div>

    <div class="row">
      <?php
      foreach($listNote as $note){
        ?>
        <div class="col-md-3 col-sm-6 no-padding">
          <div class="postit"  onclick="redirect('<?=BASE?>note/show/<?=$note->id;?>');">
            <div class="postit-header">
              <img src="<?=BASE?>img/push-pin.png" alt="Push pin">
            </div>
            <div class="postit-body" style="background-color: #<?=$note->color;?>;">
              <?=$note->title;?>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>


  </div>
</div>
