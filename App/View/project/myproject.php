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
        <a href="<?=BASE?>task/create/" class="btn btn-info mobile-full-width mb-2">Nova Tarefa</a>
        <a href="#" data-toggle="modal" data-target="#modalMember"class="btn btn-info mobile-full-width mb-2">Membros</a>
      </div>
    </div>

    <h4>Notas</h4>
    <div class="row">
      <?php
      foreach($listNote as $note){
        ?>
        <div class="col-md-2 col-sm-4 no-padding">
          <div class="card" style="border:2px solid #<?=$note->color;?>;">
            <div class="card-header font-weight-bold"><?=mb_substr($note->title, 0, 20);?></div>
            <div class="card-body" style="border-top:1px solid #<?=$note->color;?>;">
              <a href="<?=BASE?>note/show/<?=$note->id;?>" class="btn w-100" style="background-color: #<?=$note->color;?>; color: #FFF;">Acessar</a>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
    <div class="clear"></div>
    <div class="text-right">
      <p><a href="<?=BASE?>note/" class="btn btn-secondary btn-sm mobile-full-width">Mostrar todas</a></p>
    </div>

    <hr>
    <div class="row">
      <div class="col-md-3">
        <form method="post" id="frmSelectCategory">
          <label for="slCategory">Selecione Categoria</label>
          <select class="form-control" name="slCategoryId" id="slCategoryId" onchange="submitForm();">
            <option value="">Selecione</option>
            <?php foreach($categoryList as $category) :?>
              <option value="<?=$category->id?>" class="text-info" <?=$categoryId == $category->id ? "selected" : ""?>><?=$category->name?></option>
            <?php endforeach;?>
          </select>
        </form>
      </div>
    </div>
    <hr>

    <h4>Tarefas</h4>
    <div class="row">
      <div class="col">
        <div class="overflow-auto">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Criado</th>
                <th>Deadline</th>
                <th>Finalizado</th>
                <th>Status</th>
                <th>Categoria</th>
                <th>Autor</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listTask as $task) :
                $status = "Finalizado";
                $color  = "text-info";

                if($task->status == 1){
                  $status = "Ativo";
                  $color  = "text-success";
                }elseif($task->status == 2){
                  $status = "Cancelado";
                  $color  = "text-danger";
                }
                ?>
                <tr>
                  <td class="font-weight-bold">#<?=$task->id;?></td>
                  <td><?=$task->title;?></td>
                  <td><?=convertDate($task->created, DATE_FORMAT);?></td>
                  <td><?=convertDate($task->deadline, DATETIME_FORMAT);?></td>
                  <td><?=$task->completed != null ? convertDate($task->completed, DATETIME_FORMAT) : "Em aberto"?></td>
                  <td class="<?=$color;?> font-weight-bold"><?=$status;?></td>
                  <td><?=$task->taskCategoryName;?></td>
                  <td><?=$task->username;?></td>
                  <td><a href="<?=BASE?>task/show/<?=$task->id;?>" class="btn btn-info btn-sm">Visualizar</a></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!--MODAL MEMBROS-->
<div class="modal fade" id="modalMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Membros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Função</th>
              <th>Último login</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($members as $m): ?>
              <tr class="<?=$m->status == 2 ? "table-danger" : "";?>">
                <td><?=$m->name;?></td>
                <td><?=$m->position;?></td>
                <td>
                  <?php
                  if($m->lastLogin != "0000-00-00 00:00:00"){
                    echo convertDate($m->lastLogin, DATETIME_FORMAT);
                  }
                  ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!--FIM MODAL MEMBROS-->


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
<script>
  function submitForm(){
    document.getElementById("frmSelectCategory").submit();
  }
</script>
