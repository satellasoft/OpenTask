//Return value
function valueById(id){
  return document.getElementById(id).value;
}

//Set HTML
function setHTMLById(id, html){
  document.getElementById(id).innerHTML = html;
}

function redirect(url){
  document.location.href = url; 
}
