<div class="card border-info">
  <div class="card-header">
    Projeto
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/show/<?=$projectId?>">Projeto</a></li>
          <li class="breadcrumb-item active">Categoria</li>
        </ol>
      </div>

      <div class="col-md-6">
        <a href="<?=BASE?>category/create/<?=$projectId?>" class="btn btn-primary">Novo</a>
      </div>
    </div>

    <h1>Categorias - <?=$project->title;?></h1>

    <div class="overflow-auto">
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Nome</th>
            <th>Criado</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($categoryList as $category) : ?>
            <tr>
              <td class="font-weight-bold">#<?=$category->id;?></td>
              <td><?=$category->name;?></td>
              <td><?=convertDate($category->register, DATE_FORMAT);?></td>
              <td><a href="<?=BASE?>category/edit/<?=$category->id;?>" class="btn btn-warning btn-sm">Editar</a></td>
            </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
    <hr>
  </div>
</div>
