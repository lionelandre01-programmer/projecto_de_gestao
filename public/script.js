let button = document.querySelector('#toggle-btn');
let nav = document.querySelector('#menu');
button.addEventListener('click', () => {
    nav.classList.toggle('ativo');

    if (nav.classList.contains('ativo')){

        button.innerHTML = '&#10006';
    }else{
        
        button.innerHTML = '&#9776';
    }
    
});

let btn_confirma = document.querySelector('#confirmado');
btn_confirma.addEventListener('click', () => {

    let result = document.querySelector('#resultado');
    result.style.color = 'green';
    result.innerHTML = 'Confirmado';
});
