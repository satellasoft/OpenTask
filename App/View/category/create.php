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
          <li class="breadcrumb-item active">Nova Categoria</li>
        </ol>
      </div>
    </div>

    <h1>Nova categoria</h1>
    <div>
      <form action="<?=BASE?>category/store" method="post" onsubmit="return validateCategory(false);">
        <div class="row">
          <div class="col-md-6">
            <label for="txtTitle">Título</label>
            <input type="hidden" name="txtProjectId" id="txtProjectId" value="<?=$projectId?>">
            <input type="text" name="txtTitle" id="txtTitle" class="form-control" placeholder="Category title">
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
    <hr>
  </div>
</div>
<script src="<?=BASE?>js/category.js"></script>
