<div class="card border-info">
  <div class="card-header">
    Projeto
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/">Projeto</a></li>
          <li class="breadcrumb-item active">Visualizar</li>
        </ol>
      </div>
    </div>

    <h1><?=$project->title;?></h1>
    <div class="row">
      <div class="col-md-8 col-sm-12">
        <div class="overflow-auto">
          <table class="table table-dark">
            <tbody>
              <tr>
                <td><?=convertDate($project->created);?></td>
                <td><?=convertDate($project->deadline);?></td>
                <?php
                if($project->status == 1){
                  echo "<td class='table-success'>Ativo</td>";
                }else if($project->status == 2){
                  echo "<td class='table-danger'>Cancelado</td>";
                }else{
                  echo "<td class='table-info'>Finalizado</td>";
                }
                ?>
                <td><?=$project->userName;?></td>
                <td><?=$project->userPermission == 1 ? "Administrador" : "Comum";?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-4 col-sm-12">
        <a href="<?=BASE?>project/show/<?=$id?>" class="btn btn-primary m-2 ">Visualizar</a>
        <a href="<?=BASE?>userProject/show/<?=$id?>/<?=urlencode($project->title);?>" class="btn btn-primary m-2">Grupos</a>
        <a href="<?=BASE?>category/show/<?=$id?>" class="btn btn-primary m-2">Categorias</a>
        <?php if($project->status == 1): ?>
          <a href="<?=BASE?>project/edit/<?=$id?>" class="btn btn-warning m-2">Editar</a>
        <?php endif;?>
      </div>
    </div>
    <hr>
    <div>
      <?=html_entity_decode($project->description);?>
    </div>
  </div>
</div>
