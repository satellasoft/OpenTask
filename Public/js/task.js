document.addEventListener("DOMContentLoaded", function(){
  $("#dvTaskContent").hide();

  $("#btnShowTaskContent").click(function(){
    $("#dvTaskContent").toggle();
  });
}, false);

function validateProject(update = false){
  var msg = "";

  if(update && valueById("txtId") <= 0)
    msg += "<p>- ID não encontrado</p>";

  if(valueById("txtTitle").length < 3 || valueById("txtTitle").length > 150)
    msg += "<p>- Título inválido</p>";

  if(valueById("txtDeadline") == "")
      msg += "<p>- Deadline inválido</p>";

  if(CKEDITOR.instances['txtDescription'].getData().length < 10)
    msg += "<p>- Descrição inválida</p>";

  if(valueById("slStatus") < 1 || valueById("slStatus") > 3)
    msg += "<p>- Status inválido</p>";

  setHTMLById("dvAlert", msg);

  return msg == "";
}
