<div class="card border-info">
  <div class="card-header">
    Editar nota
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/myproject/">Projeto</a></li>
          <li class="breadcrumb-item active">Nota</li>
        </ol>
      </div>
    </div>

    <form action="<?=BASE?>note/update" method="post" onsubmit="return validateNote(true);">
      <div class="row">
        <div class="col-md-6">
          <label for="txtTitle">Título da nota</label>
          <input type="hidden" name="txtId" id="txtId" value="<?=$id;?>">
          <input type="text" name="txtTitle" id="txtTitle" class="form-control" placeholder="Note title" value="<?=$note->title;?>">
        </div>

        <div class="col-md-2">
          <label for="slColor">Cor de fundo<?=$note->color?></label>
          <select class="form-control" name="slColor" id="slColor">
            <option <?= $note->color == "d1d1d1" ? "selected" : ""?> value="d1d1d1" style="background-color: #d1d1d1;">Cinza</option>
            <option <?= $note->color == "e06565" ? "selected" : ""?> value="e06565" style="background-color: #e06565;">Vermelho</option>
            <option <?= $note->color == "e09a65" ? "selected" : ""?> value="e09a65" style="background-color: #e09a65;">Laranja</option>
            <option <?= $note->color == "e0d265" ? "selected" : ""?> value="e0d265" style="background-color: #e0d265;">amarelo</option>
            <option <?= $note->color == "65e06d" ? "selected" : ""?> value="65e06d" style="background-color: #65e06d;">Verde</option>
            <option <?= $note->color == "65b9e0" ? "selected" : ""?> value="65b9e0" style="background-color: #65b9e0;">Azul</option>
            <option <?= $note->color == "9a65e0" ? "selected" : ""?> value="9a65e0" style="background-color: #9a65e0;">Roxo</option>
            <option <?= $note->color == "e065ce" ? "selected" : ""?> value="e065ce" style="background-color: #e065ce;">Rosa 1</option>
            <option <?= $note->color == "e06594" ? "selected" : ""?> value="e06594" style="background-color: #e06594;">Rosa 2</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="slStatus">Status</label>
          <select class="form-control" name="slStatus" id="slStatus">
            <option value="1" class="text-info" <?=$note->status == 1 ? "selected" : ""?>>Ativo</option>
            <option value="2" class="text-danger" <?=$note->status == 2 ? "selected" : ""?>>Cancelado</option>
          </select>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col">
          <textarea name="txtDescription" id="txtDescription"><?=$note->content?></textarea>
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
          <button type="submit" name="btnCreate" class="btn btn-success">Alterar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?=BASE?>ckeditor/ckeditor.js"></script>
<script src="<?=BASE?>js/note.js"></script>
<script>
CKEDITOR.replace("txtDescription");
</script>
