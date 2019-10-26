<div class="card border-info">
  <div class="card-header">
    Bem-vindo(a), <span class="font-weight-bold"><?=$_SESSION["n"]?></span>
  </div>
  <div class="card-body">
    <div class="row">
      <?php
      foreach($listProject as $project){
        ?>
        <div class="col-md-4 no-padding">
          <div class="card border-info mb-3">
            <div class="card-header"><span class="font-weight-bold"><?=mb_substr($project->title, 0, 25);?></span> - <?=convertDate($project->deadline, "d/m/Y");?></div>
            <div class="card-body">
              <ul>
                <li> <a href="#">teste 1</a> </li>
                <li> <a href="#">teste 22</a> </li>
                <li> <a href="#">teste 333</a> </li>
              </ul>
            </div>
            <div class="card-footer">
              <a href="<?=BASE?>userproject/check/<?=$project->id;?>" class="w-100 btn btn-info btn-sm">Acessar</a>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>
</div>
