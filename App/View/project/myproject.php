<div class="card border-info">
  <div class="card-header">
    <?=$project->title?>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 no-padding">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item active">Projeto</li>
        </ol>
      </div>
      <div class="col-md-6 no-padding">
        <button type="button" class="btn btn-primary mobile-full-width mb-2" data-toggle="modal" data-target="#modalDescription">Detalhes do projeto</button>
        <a href="<?=BASE?>note/create/" class="btn btn-info mobile-full-width mb-2">Nova Nota</a>
        <a href="#" class="btn btn-info mobile-full-width mb-2">Nova Tarefa</a>
      </div>
    </div>

    <h4>Notas</h4>
    <div class="row">
      <?php
    foreach($listNote as $note){
        ?>
        <div class="col-md-3 col-sm-6 no-padding">
          <div class="postit" onclick="redirect('<?=BASE?>note/show/<?=$note->id;?>');">
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
    <p class="text-right"><a href="<?=BASE?>note/" class="btn btn-secondary btn-sm mobile-full-width">Mostrar todas >>></a></p>
    <hr>
  </div>
</div>
<!--MODAL DESCRIPTION-->

<div class="modal fade" id="modalDescription" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?=$project->title?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          <span class="font-weight-bold">Criado: </span> <?=$project->created?> -
          <span class="font-weight-bold">Deadline: </span> <?=$project->deadline?> -
          <span class="font-weight-bold">Autor: </span> <?=$project->userName?>
        </p>
        <hr>
        <div>
          <?=html_entity_decode($project->description)?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</div>
