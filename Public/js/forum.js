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

function validateForumComment(){
  var msg = "";

  if(valueById("txtForumId") <= 0)
  msg += "<p>- Fórum não encontrado</p>";

  if(CKEDITOR.instances['txtContent'].getData().length < 10)
  msg += "<p>- Conteúdo inválido</p>";

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
