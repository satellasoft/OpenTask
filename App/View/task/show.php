<div class="card border-info">
  <div class="card-header">
    <?=$task->title?>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/myproject">Meu Projeto</a></li>
          <li class="breadcrumb-item active"><?=$task->title?></li>
        </ol>
      </div>
    </div>

    <div class="card text-white bg-primary mb-3">
      <div class="card-header">Descrição</div>
      <div class="card-body">
        <h4 class="card-title"><?=$task->title?></h4>

        <div class="overflow-auto">
          <table class="table text-white">
            <thead>
              <tr>
                <th>Deadline</span></th>
                <th>Status</th>
                <th>Criado</th>
                <th>Autor</th>
                <th>Opções</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-info">
                <td><?=convertDate($task->deadline, DATE_FORMAT)?></td>
                <td><?=$task->status == 1 ? "Ativo" : "Finalizado";?></td>
                <td><?=convertDate($task->created, DATETIME_FORMAT)?></td>
                <td><?=$task->username;?></td>
                <td><?php if($task->userid == $_SESSION['i']){ ?>
                  <a href="<?=BASE?>task/edit/<?=$task->id;?>" class="btn btn-primary btn-sm">Editar</a>
                <?php }else{ echo "---"; } ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <button id="btnShowTaskContent" type="button" name="button" class="btn btn-secondary btn-sm">Mostrar descrição >>></button>
        <div class="text-white mt-3" id="dvTaskContent">
          <?=html_entity_decode($task->description);?>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?=BASE?>js/task.js"></script>
