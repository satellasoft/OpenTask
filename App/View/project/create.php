<div class="card border-info">
  <div class="card-header">
    Novo projeto
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/">Projeto</a></li>
          <li class="breadcrumb-item active">Novo Projeto</li>
        </ol>
      </div>
    </div>

    <form action="<?=BASE?>project/store" method="post" onsubmit="return validateProject(false);">
      <div class="row">
        <div class="col-md-4">
          <label for="txtTitle">Título</label>
          <input type="text" name="txtTitle" id="txtTitle" class="form-control" placeholder="Project title">
        </div>

        <div class="col-md-4">
          <label for="txtDeadline">Deadline</label>
          <input type="datetime-local" name="txtDeadline" id="txtDeadline" class="form-control">
        </div>

        <div class="col-md-4">
          <label for="slStatus">Status</label>
          <select class="form-control" name="slStatus" id="slStatus">
            <option value="1" class="text-info">Ativo</option>
            <option value="2" class="text-danger">Cancelado</option>
            <option value="3" class="text-info">Finalizado</option>
          </select>
        </div>
      </div>

        <div class="row mt-3">
          <div class="col">
            <textarea name="txtDescription" id="txtDescription"></textarea>
          </div>
        </div>

      <div class="row mt-3">
        <div class="col-md-6">
          <div class="alert alert-info" id="dvAlert">
            Preencha corretamente todos os campos.
          </div>
        </div>

        <div class="col-md-6">
          <button type="submit" name="btnCreate" class="btn btn-success">Criar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?=BASE?>ckeditor/ckeditor.js"></script>
<script src="<?=BASE?>js/project.js"></script>
<script>
CKEDITOR.replace("txtDescription");
</script>
