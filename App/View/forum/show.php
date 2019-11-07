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
    <button onclick="showModal('dvModalComment');" type="button" name="button" class="btn btn-success btn-sm">Comentar</button>

    <hr>

    <?php
      foreach($listComment as $comment){
        ?>
        <div class="card mb-3">
          <div class="card-header">
            <p><span class="font-weight-bold">Criado em </span> <?=convertDate($comment->created, DATETIME_FORMAT); ?> <span class="font-weight-bold">Por </span> <?=$comment->username; ?></p>
          </div>

          <div class="card-body">
            <?=html_entity_decode($comment->content);?>
          </div>
        </div>
        <?php
      }
    ?>

  </div>
</div>
<br>

<div id="dvModalComment" class="op-modal-bg">
  <div class="op-modal-content">
    <form action="<?=BASE?>forum/comment" method="post" onsubmit="return validateForumComment()">
      <div class="op-modal-header">
        Comentar
      </div>

      <div class="op-modal-body">
        <input type="hidden" name="txtForumId" id="txtForumId" value="<?=$forum->getTask()->getId();?>">
        <textarea name="txtContent" id="txtContent"></textarea>
        <div class="alert alert-info" id="dvAlert">
          &nbsp;
        </div>
      </div>

      <div class="op-modal-footer">
        <button type="button" name="button" class="btn btn-danger btn-sm" onclick="closeModal('dvModalComment');">Fechar</button>
        <button type="submit" name="button" class="btn btn-success btn-sm">Comentar</button>
      </div>
    </form>
  </div>
</div>

<script src="<?=BASE?>ckeditor/ckeditor.js"></script>
<script src="<?=BASE?>js/forum.js"></script>

<script src="<?=BASE?>/highlight/highlight.pack.js"></script>
<script>
RunHeighLight();
CKEDITOR.replace("txtContent");
</script>
