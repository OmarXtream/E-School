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