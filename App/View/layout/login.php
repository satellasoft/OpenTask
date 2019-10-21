<div style="max-width:450px; margin: 0 auto; margin-top: 5%;">
  <div class="card border-secondary">
    <div class="card-header">
      <img src="<?=BASE?>img/logo_color.png" alt="Open Task Logo" style="max-width:32px;">
      Login - Open Task
    </div>
    <div class="card-body">
      <form method="post" onsubmit="return login();">
        <div>
          <label for="txtUsername">Usuário</label>
          <input type="text" class="form-control" id="txtUsername" placeholder="gunner.correa">
        </div>

        <div class="mt-3">
          <label for="txtPassword">Senha</label>
          <input type="password" class="form-control" id="txtPassword" placeholder="*******">
        </div>

        <div class="mt-3">
          <button type="submit" name="btnLogin" class="btn btn-secondary w-100">Login</button>
        </div>

        <div class="alert alert-info mt-3" id="alertLogin">
          <p>- Preencha corretamente todos os campos</p>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function login(){
    var msg = "";
    if(document.getElementById("txtUsername").value.length < 2){
      msg += "<p>- Invalid user name</p>";
    }

    if(document.getElementById("txtPassword").value.length < 7){
      msg += "<p>- Invalid password</p>";
    }

    if(msg == ""){
      return true;
    }else{
      document.getElementById("alertLogin").innerHTML = msg;
      return false;
    }

  }
</script>
