<div class="card border-info">
  <div class="card-header">
    Usuário
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item active">Usuário</li>
        </ol>
      </div>
      <div class="col-md-6">
        <a href="<?=BASE?>user/create" class="btn btn-primary">Novo</a>
      </div>
    </div>

    <div class="overflow-auto">
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Login</th>
            <th>Permissão</th>
            <th>Status</th>
            <th>Registrado</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($listUser as $user){
            ?>
            <tr class="<?=$user->getStatus() == 2 ? "table-danger" : "";?>">
              <td>#<?=$user->getId();?></td>
              <td><?=$user->getName();?></td>
              <td><?=$user->getEmail();?></td>
              <td><?=$user->getLogin();?></td>
              <td><?=$user->getPermission() == 1 ? "Admin" : "Comum";?></td>
              <td><?=$user->getStatus() == 1 ? "Ativo" : "Bloqueado";?></td>
              <td><?=date("d/m/Y H:i:s", strtotime($user->getRegister()));?></td>
              <td>
                <a href="<?=BASE?>user/edit/<?=$user->getId();?>" class="btn btn-warning">Editar</a>
                <a href="<?=BASE?>user/passwordreset/<?=$user->getId();?>" target="_blank" class="btn btn-info" onclick="return confirm('Deseja resetar a senha?')">Resetar senha</a>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>
