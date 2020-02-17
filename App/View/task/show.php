<div class="card border-info">
  <div class="card-header">
    <?=$task->title?>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/myproject">Meu Projeto</a></li>
          <li class="breadcrumb-item active"><?=$task->title;?></li>
        </ol>
      </div>

      <div class="col-md-6">
        <?php if( $task->completed == null): ?>
          <a href="<?=BASE?>forum/create/<?=$task->id?>" class="btn btn-info">Novo fórum</a>
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalUpload">Upload</a>
        <?php endif; ?>
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
                <th>Criado</th>
                <th>Deadline</th>
                <th>Finalizado</th>
                <th>Status</th>
                <th>Autor</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-info">
                <td><?=convertDate($task->created, DATETIME_FORMAT)?></td>
                <td><?=convertDate($task->deadline, DATE_FORMAT)?></td>
                <td><?=$task->completed != null ? convertDate($task->completed, DATETIME_FORMAT) : "Em aberto"?></td>
                <td><?=$task->status == 1 ? "Ativo" : "Finalizado";?></td>
                <td><?=$task->username;?></td>
                <td><?php if($task->userid == $_SESSION['i'] && $task->completed == null){ ?>
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

    <hr>

    <?php
    $i = 0;
    foreach($forum as $f){
      $i++;
      ?>
      <div class="card mb-3">
        <div class="card-header">
          <a class="btn btn-secondary btn-sm" data-toggle="collapse" href="#collapse<?=$i?>" role="button" aria-expanded="true" aria-controls="collapse<?=$i?>">[+]</a>&nbsp;&nbsp;
          <span class="font-weight-bold">Criado em: </span> <?=convertDate($f->created, DATETIME_FORMAT)?>___<span class="font-weight-bold">Por: </span> <?=$f->userName;?>
        </div>
        <div class="card-body" id="collapse<?=$i?>">
          <h4 class="card-title"><?=$f->title?></h4>
          <div>
            <?=html_entity_decode($f->content);?>
          </div>

          <a href="<?=BASE?>forum/show/<?=$f->id;?>" class="btn btn-info btn-sm">Visualizar</a>

        </div>
      </div>
      <?php
    }
    ?>

    <!--ARQUIVOS-->
    <div class="card mb-3" id="dvFiles">
      <div class="card-header"><span class="font-weight-bold">Arquivos</span></div>
      <div class="card-body">
        <div class="overflow-auto">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>Título</th>
                <th>Arquivo</th>
                <th>Enviado por</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($uploads as $up){
                if($up->type == "f"){
                  $fullDir = BASE . "" . FILE_PATH . "/" . $up->file;
                  ?>
                  <tr>
                    <td><?=$up->title?></td>
                    <td>
                      <a href="<?=$fullDir;?>" download class="btn btn-primary btn-sm"><?=$up->file?></a>
                    </td>
                    <td>
                      <?php
                      echo $up->userName;
                      if($userId == $up->userId){
                        ?>
                        <a href="<?=BASE?>upload/remove/<?=$up->fileId?>/<?=$task->id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente remover?');">[X]</a>
                        <?php
                      }
                      ?>
                    </td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <hr>
      </div>
    </div>

    <!--Imagens-->
    <div class="card mb-3" id="dvImages">
      <div class="card-header"><span class="font-weight-bold">Imagens</span></div>
      <div class="card-body">
        <div class="overflow-auto">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>Título</th>
                <th>Arquivo</th>
                <th>Enviado por</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($uploads as $up){
                if($up->type == "i"){
                  $fullDir = BASE . "" . IMAGE_PATH . "/" . $up->file;
                  ?>
                  <tr>
                    <td><?=$up->title?></td>
                    <td>
                      <a href="<?=$fullDir;?>" download class="btn btn-primary btn-sm">Download</a>
                      <a href="<?=$fullDir;?>" target="_blank" class="btn btn-info btn-sm">Visualizar</a>
                    </td>
                    <td>
                      <?php
                      echo $up->userName;
                      if($userId == $up->userId){
                        ?>
                        <a href="<?=BASE?>upload/remove/<?=$up->fileId?>/<?=$task->id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente remover?');">[X]</a>
                        <?php
                      }
                      ?>
                    </td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <hr>
      </div>
    </div>

    <!--END-->
  </div>
</div>

<div class="text-right mt-3 mb-3">
  <a href="#dvTop" class="btn btn-secondary btn-sm">Topo</a>
</div>

<!---MODAL UPLOAD-->
<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="frmUpload" action="<?=BASE?>upload/store" method="post" enctype="multipart/form-data" onsubmit="return validateUpload();">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload de arquivos</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="txtTaskId" id="txtTaskId" value="<?=$task->id?>">
          <input type="text" name="txtUploadTitle" id="txtUploadTitle" placeholder="Título" class="form-control">

          <select class="form-control mt-2" name="slType" id="slType">
            <option value="f">Arquivo</option>
            <option value="i">Imagem</option>
          </select>

          <div class="alert alert-dismissible alert-secondary mt-2">
            <span class="label">Arquivo, Max 50MB - Imagem, Max 1MB</span>
          </div>

          <div class="custom-file">
            <input accept=".zip" type="file" class="custom-file-input" id="flFile" name="flFile">
            <label class="custom-file-label" for="flFile">Escolha o Arquivo</label>
          </div>

          <div class="alert alert-info mt-2" id="dvAlert">
            &nbsp;
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-success">Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!---END MODAL UPLOAD-->

<script src="<?=BASE?>js/task.js"></script>
<script src="<?=BASE?>js/forum.js"></script>
<script src="<?=BASE?>js/upload.js"></script>
<script src="<?=BASE?>vendor/highlight/highlight.pack.js"></script>
<script>RunHeighLight();</script>
