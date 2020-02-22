<div class="card border-info">
  <div class="card-header">
    Projeto
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/show/<?=$projectId?>">Projeto</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>category/show/<?=$projectId?>">Categoria</a></li>
          <li class="breadcrumb-item active">Editar Categoria</li>
        </ol>
      </div>
    </div>

    <h1>Editar categoria</h1>
    <div>
      <form action="<?=BASE?>category/update" method="post" onsubmit="return validateCategory(true);">
        <div class="row">
          <div class="col-md-6">
            <label for="txtTitle">Título</label>
            <input type="hidden" name="txtId" id="txtId" value="<?=$category->id?>">
            <input type="hidden" name="txtProjectId" id="txtProjectId" value="<?=$category->projectId?>">
            <input type="text" name="txtTitle" id="txtTitle" class="form-control" value="<?=$category->name?>">
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
            <button type="submit" name="btnEdit" class="btn btn-success">Editar</button>
          </div>
        </div>
      </form>
    </div>
    <hr>
  </div>
</div>
<script src="<?=BASE?>js/category.js"></script>
