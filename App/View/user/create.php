<div class="card border-info">
  <div class="card-header">
    Novo usuário
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=BASE?>user/">Usuário</a></li>
          <li class="breadcrumb-item active">Novo Usuário</li>
        </ol>
      </div>
    </div>

    <form action="<?=BASE?>user/store" method="post" onsubmit="return validate(false);">
      <div class="row">
        <div class="col-md-4">
          <label for="txtName">Nome</label>
          <input type="text" name="txtName" id="txtName" class="form-control" placeholder="User Full Name">
        </div>

        <div class="col-md-4">
          <label for="txtEmail">E-mail</label>
          <input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="email@domain.com">
        </div>

        <div class="col-md-4">
          <label for="txtLogin">Login</label>
          <input type="text" name="txtLogin" id="txtLogin" class="form-control" placeholder="login.name">
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-4">
          <label for="txtPassword">Senha</label>
          <input type="text" name="txtPassword" id="txtPassword" class="form-control" placeholder="*******">
        </div>

        <div class="col-md-4">
          <label for="slStatus">Status</label>
          <select class="form-control" name="slStatus" id="slStatus">
            <option value="1">Ativo</option>
            <option value="2">Bloqueado</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="slPermission">Permissão</label>
          <select class="form-control" name="slPermission" id="slPermission">
            <option value="1">Administrador</option>
            <option value="2" selected>Comum</option>
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
          <button type="submit" name="btnCreate" class="btn btn-success">Criar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?=BASE?>js/user.js"></script>
