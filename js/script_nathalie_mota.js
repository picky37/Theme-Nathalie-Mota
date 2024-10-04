console.log('connecté !');


const popup = document.getElementById('modale_container');
console.log(popup);
const closeButton = document.getElementById('closeButton');
const menuLink = document.getElementById('menu-item-26');


menuLink.addEventListener('click', () => {
    popup.classList.toggle('show');
    console.log('close');
});
 
const burger = document.querySelector('.logo_burger');
const menuMobile = document.querySelector('.modal');
console.log(menuMobile);
burger.addEventListener('click', () => {
    console.log('burger cliqué');
    menuMobile.classList.toggle('changeMenuMobile');
});