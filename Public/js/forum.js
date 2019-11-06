function validateProject(){
  var msg = "";

  if(valueById("txtTaskId") <= 0)
  msg += "<p>- Tarefa não encontrado</p>";

  if(valueById("txtTitle").length < 3 || valueById("txtTitle").length > 150)
  msg += "<p>- Título inválido</p>";

  if(CKEDITOR.instances['txtDescription'].getData().length < 10)
  msg += "<p>- Descrição inválida</p>";

  setHTMLById("dvAlert", msg);

  return msg == "";
}

function RunHeighLight(){
  document.addEventListener("DOMContentLoaded", function(){
    $('pre code').each(function (i, block) {
      hljs.highlightBlock(block);
    });
  }, false);
}
