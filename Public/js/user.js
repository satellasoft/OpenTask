function validate(update = false){
  var msg = "";

  if(update && valueById("txtId") <= 0)
    msg += "<p>- ID não encontrado</p>";

  if(valueById("txtName").length < 7)
    msg += "<p>- Nome inválido</p>";

  if(valueById("txtEmail").indexOf("@") <=0 || valueById("txtEmail").indexOf(".") <=0)
    msg += "<p>- E-mail inválido</p>";

  if(valueById("txtLogin").length < 7 || valueById("txtLogin").indexOf(".") <=0)
    msg += "<p>- Login inválido. Ex. gunnar.correa</p>";

  if(!update && valueById("txtPassword").length < 7)
    msg += "<p>- Senha inválida</p>";

  if(valueById("slStatus") < 1 || valueById("slStatus") > 2)
    msg += "<p>- Status inválido</p>";

  if(valueById("slPermission") < 1 || valueById("slPermission") > 2)
    msg += "<p>- Permissão inválida</p>";

  setHTMLById("dvAlert", msg);

  return msg == "";
}
