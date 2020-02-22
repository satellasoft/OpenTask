function validateCategory(update = false){
  var msg = "";

  if(update && valueById("txtId") <= 0)
  msg += "<p>- ID não encontrado</p>";

  if(valueById("txtTitle").length < 3 || valueById("txtTitle").length > 150)
  msg += "<p>- Título inválido</p>";

  if(valueById("txtProjectId") <= 0)
  msg += "<p>- Projeto não identificado</p>";

  setHTMLById("dvAlert", msg);

  return msg == "";
}
