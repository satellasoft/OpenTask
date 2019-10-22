<div class="card border-info">
  <div class="card-header">
    Alterar senha
  </div>
  <div class="card-body">
    <form  action="<?=BASE?>user/passwordupdate" method="post" onsubmit="return validatePassword();">
      <div class="row">
        <div class="col">
          <label for="txtPassword">Password</label>
          <input type="text" name="txtPassword" id="txtPassword" class="form-control">
          <div id="dvAlert" class="alert alert-info mt-3">
            <p>- Informe sua nova senha</p>
          </div>
          <input type="submit" name="btnSend" class="btn btn-success mt-1 float-right" value="Alterar">
        </div>

        <div class="col">
          <div>
            <p>- Insira uma senha com no minimo sete caracteres.</p>
            <p>- Sua senha é intransferível.</p>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?=BASE?>js/user.js"></script>
