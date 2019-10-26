<div class="card border-info">
  <div class="card-header">
    Grupo
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>project/">Projeto</a></li>
          <li class="breadcrumb-item active">Grupo</li>
        </ol>
      </div>
      <div class="col-md-6">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalInsert">Novo</a>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col">
        <div class="overflow-auto">
          <table class="table table-hover table-spriped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Função</th>
                <th>E-mail</th>
                <th>Login</th>
                <th>Permissão</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($listUserProject as $user){
                $statusUrl = "{$user->id}/{$projectId}/{$user->status}";
                ?>
                <tr>
                  <td><?=$user->name;?></td>
                  <td classs="font-weight-bold"><?=$user->position;?></td>
                  <td><?=$user->email;?></td>
                  <td><?=$user->login;?></td>
                  <td><?=$user->permission == 1 ? "Administrador" : "Comum";?></td>
                  <td>
                    <a href="<?=BASE?>userproject/changestatus/<?=$statusUrl?>" class="btn <?=$user->status == 1 ? 'btn-danger' : 'btn-success'?>"><?=$user->status == 1 ? 'Bloquear' : 'Habilitar'?></a>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalInsert">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?=BASE?>userproject/store" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Inserir usuários</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label for="txtPosition">Função</label>
              <input type="hidden" name="txtProjectId" id="txtProjectId" value="<?=$projectId?>">
              <input type="text" name="txtPosition" id="txtPosition" placeholder="Programmer" class="form-control">
            </div>

            <div class="col-md-6">
              <label for="slUserId">Usuário</label>
              <select name="slUserId" id="slUserId" class="form-control">
                <?php
                foreach($listUserNotProject as $user){
                  ?>
                  <option value="<?=$user->id;?>"><?=$user->name;?></option>
                  <?php
                }
                ?>
              </select>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Inserir</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>
