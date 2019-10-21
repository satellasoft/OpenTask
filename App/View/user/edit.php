<div class="card border-info">
  <div class="card-header">
    Editar usuário
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>user/">Usuário</a></li>
          <li class="breadcrumb-item active">Editar Usuário</li>
        </ol>
      </div>
    </div>

    <form action="<?=BASE?>user/update" method="post" onsubmit="return validate(true);">
      <div class="row">
        <div class="col-md-4">
          <label for="txtName">Nome</label>
          <input type="hidden" name="txtId" id="txtId" value="<?=$user->id;?>">
          <input type="text" name="txtName" id="txtName" class="form-control" placeholder="User Full Name" value="<?=$user->name;?>">
        </div>

        <div class="col-md-4">
          <label for="txtEmail">E-mail</label>
          <input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="email@domain.com" value="<?=$user->email;?>">
        </div>

        <div class="col-md-4">
          <label for="txtLogin">Login</label>
          <input type="text" name="txtLogin" id="txtLogin" class="form-control" placeholder="login.name" value="<?=$user->login;?>">
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-4">
          <label for="txtPassword">Senha</label>
          <input type="text" name="txtPassword" id="txtPassword" class="form-control" placeholder="*******" disabled>
        </div>

        <div class="col-md-4">
          <label for="slStatus">Status</label>
          <select class="form-control" name="slStatus" id="slStatus">
            <option value="1" <?=$user->status == 1 ? 'selected' : '';?>>Ativo</option>
            <option value="2" <?=$user->status == 2 ? 'selected' : '';?>>Bloqueado</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="slPermission">Permissão</label>
          <select class="form-control" name="slPermission" id="slPermission">
            <option value="1" <?=$user->permission == 1 ? 'selected' : '';?>>Administrador</option>
            <option value="2" <?=$user->permission == 2 ? 'selected' : '';?>>Comum</option>
          </select>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-6">
          <div class="alert alert-info" id="dvAlert">
            Preencha corretamente todos os campos.
          </div>
        </div>

        <div class="col-md-6">
          <button type="submit" name="btnEdit" class="btn btn-success">Editar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?=BASE?>js/user.js"></script>
