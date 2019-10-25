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
                <th>E-mail</th>
                <th>Login</th>
                <th>Permissão</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($listUser as $user){
                ?>
                <tr>
                  <td><?=$user->name;?></td>
                  <td><?=$user->email;?></td>
                  <td><?=$user->login;?></td>
                  <td><?=$user->permission == 1 ? "Administrador" : "Comum";?></td>
                  <td>
                    <a href="<?=BASE?>group/delete/<?=$user->id;?>" class="btn btn-warning" onclick="return confirm('Deseja realmente remover o usuário do projeto?')">Remover</a>
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
      <div class="modal-header">
        <h5 class="modal-title">Inserir usuários</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Inserir</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
