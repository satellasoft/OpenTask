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
        <div class="col-md-2 col-sm-4 no-padding">
          <div class="card" style="border:2px solid #<?=$note->color;?>;">
            <div class="card-header font-weight-bold"><?=mb_substr($note->title, 0, 20);?></div>
            <div class="card-body" style="border-top:1px solid #<?=$note->color;?>;">
              <a href="<?=BASE?>note/show/<?=$note->id;?>" class="btn w-100" style="background-color: #<?=$note->color;?>; color: #FFF;">
                <?=$note->title;?></a>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
    

  </div>
</div>
