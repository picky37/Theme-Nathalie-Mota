console.log('connecté !');

const button = document.getElementById('myButton');
const popup = document.getElementById('modale_container');
const closeButton = document.getElementById('closeButton');


button.addEventListener('click', () => {
    popup.classList.remove('hidden');
});

closeButton.addEventListener('click', () => {
    popup.classList.add('hidden');
});