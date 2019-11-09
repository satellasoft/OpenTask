<div class="card border-info">
  <div class="card-header">
    Bem-vindo(a), <span class="font-weight-bold"><?=$_SESSION["n"]?></span>
  </div>
  <div class="card-body">
    <div class="row">
      <?php
      foreach($listProject as $project){
        $percent = calculateDatePercentage($project->created, $project->deadline);
        $class = "";

        if($percent <= 45){
          $class = "info";
        }elseif($percent > 45 && $percent <= 75){
          $class = "warning";
        }elseif($percent > 75 && $percent < 100){
          $class = "danger";
        }elseif($percent >= 100){
          $class = "success";
        }
        ?>
        <div class="col-md-4 no-padding">
          <div class="card border-<?=$class;?> mb-3">
            <div class="card-header"><span class="font-weight-bold"><?=mb_substr($project->title, 0, 25);?></span></div>
            <div class="card-body text-center">
                <?=convertDate($project->deadline, DATETIME_FORMAT);?>
              <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-<?=$class;?>" role="progressbar" aria-valuenow="<?=$percent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percent;?>%"></div>
              </div>
              <h4><span class='font-weight-bold text-<?=$class;?>'><?=$percent;?>%</span></h4>

            </div>
            <div class="card-footer">
              <a href="<?=BASE?>userProject/check/<?=$project->id;?>" class="w-100 btn btn-<?=$class;?> btn-sm">Acessar</a>
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
