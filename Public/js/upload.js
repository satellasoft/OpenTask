document.getElementById("slType").addEventListener("change", function(){
  var type = document.getElementById("slType");
  var file = document.getElementById("flFile");

  if(type.value == "i")
  updateAttribute(file, "accept", "image/*");
  else
  updateAttribute(file, "accept", ".zip");
});


function validateUpload(){
  var msg = "";

  if(valueById("txtTaskId") <= 0)
    msg += "<p>- ID da tarefa não encontrado</p>";

  if(valueById("txtUploadTitle").length < 3 || valueById("txtUploadTitle").length > 100)
  msg += "<p>- Título inválido</p>";

  if(document.getElementById("flFile").files.length == 0 )
    msg += "<p>- Selecione um arquivo inválido</p>";

  setHTMLById("dvAlert", msg);

  return msg == "";
}
