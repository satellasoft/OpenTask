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
              <td><?=$project->userPermission == 1 ? "Admintrador" : "Comum";?></td>
              <td>
                <?php
                if($project->status == 1){
                  ?>
                    <a href="<?=BASE?>project/edit/<?=$id?>" class="btn btn-warning">Editar</a>
                  <?php
                }
                ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div>
        <?=html_entity_decode($project->description);?>
      </div>

    </div>
  </div>
