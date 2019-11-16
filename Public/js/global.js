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

function getCurrentDate(){
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  return yyyy + "-" + mm + "-" + dd;
}

function updateAttribute(el, attr, value){
  if(el.hasAttribute(attr))
    el.removeAttribute(attr);
  el.setAttribute(attr, value);
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
