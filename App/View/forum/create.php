<div class="card border-info">
  <div class="card-header">
    Novo Fórum
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>task/show/<?=$taskId;?>">Tarefa</a></li>
          <li class="breadcrumb-item active">Novo Fórum</li>
        </ol>
      </div>
    </div>

    <form action="<?=BASE?>forum/store" method="post" onsubmit="return validateProject();">
      <div class="row">
        <div class="col-md-12">
          <label for="txtTitle">Título</label>
          <input type="hidden" name="txtTaskId" id="txtTaskId" value="<?=$taskId;?>">
          <input type="text" name="txtTitle" id="txtTitle" class="form-control" placeholder="Project title">
        </div>
      </div>

      <div class="row mt-3">
        <div class="col">
          <textarea name="txtDescription" id="txtDescription"></textarea>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-info" id="dvAlert">
            Preencha corretamente todos os campos.
          </div>
        </div>

        <div class="col-md-6 ">
          <button type="submit" name="btnCreate" class="btn btn-success">Criar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?=BASE?>ckeditor/ckeditor.js"></script>
<script src="<?=BASE?>js/forum.js"></script>
<script>CKEDITOR.replace("txtDescription");</script>
