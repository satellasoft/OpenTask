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


/*MODAL*/

function showModal(id){
  var el = document.getElementById(id);
  if(el == null)
    return;
  el.style.display = "block";
}

function closeModal(id){
  var el = document.getElementById(id);
  if(el == null)
    return;
  el.style.display = "none";
}

/*END MODAL*/
