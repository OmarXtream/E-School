$( document ).ready(function() {
  $("#page-content").css("min-height", $(window).height()-$('header').innerHeight()-$('nav').innerHeight())

});

const animateCSS = (element, animation, prefix = 'animate__') =>
  new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    const node = document.querySelector(element);
    node.classList.add(`${prefix}animated`, animationName);
    function handleAnimationEnd() {
      node.classList.remove(`${prefix}animated`, animationName);
      node.removeEventListener('animationend', handleAnimationEnd);
      resolve('Animation ended');
    }
    node.addEventListener('animationend', handleAnimationEnd);
});


var xmlhttp;
var token=document.getElementsByTagName('meta')["csrf-token"].content;

function handleResponse(response){
response.then(function(response){
 if(typeof response.updatetoken != 'undefined'){
   document.getElementsByTagName('meta')["csrf-token"].content = response.updatetoken;
 }
});
return response;
}
function sendData(url = ``, data = '', method = 'POST',token = true) {
 if(method == 'POST'){
 return fetch(url, {
     method: method, // *GET, POST, PUT, DELETE, etc.
     mode: "cors", // no-cors, cors, *same-origin
     cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
     credentials: "same-origin", // include, same-origin, *omit
     headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": document.getElementsByName('csrf-token')[0].getAttribute('content')
          },
     redirect: "follow", // manual, *follow, error
     body: data // body data type must match "Content-Type" header
 })
 .then(response => handleResponse(response.json())); // parses response to JSON
 } else if(method == 'GET'){

     return fetch(ajax_location + url + '?' + data).then(response => handleResponse(response.json()));
 }

}
if (window.XMLHttpRequest) {
 xmlhttp = new XMLHttpRequest();
} else {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
