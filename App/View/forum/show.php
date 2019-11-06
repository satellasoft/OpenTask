<div class="card border-info">
  <div class="card-header">
    <?=$forum->getTitle();?>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>task/show/<?=$forum->getTask()->getId();?>">Tarefa</a></li>
          <li class="breadcrumb-item active">Visualizar Fórum</li>
        </ol>
      </div>
    </div>

    <div class="overflow-auto">
      <table class="table table-hover table-success">
        <thead>
          <tr>
            <th>Tarefa</th>
            <th>Autor</th>
            <th>Criado</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?=$forum->getTask()->getTitle();?></td>
            <td><?=$forum->getUser()->getName();?></td>
            <td><?=convertDate($forum->getCreated(), DATETIME_FORMAT);?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <?=html_entity_decode($forum->getContent());?>
    </div>

  </div>
</div>
<script src="<?=BASE?>js/forum.js"></script>
<script src="<?=BASE?>/highlight/highlight.pack.js"></script>
<script>
  RunHeighLight();
</script>
