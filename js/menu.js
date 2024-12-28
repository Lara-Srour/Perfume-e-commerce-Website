let menu = document.querySelector("#menu-icon");
let navbar = document.querySelector('.navbar');

menu.addEventListener('click', () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
});

window.onscroll = () =>{
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');

}


document.addEventListener('DOMContentLoaded', function() {
    const minusBtn = document.querySelector('.minus-btn');
    const plusBtn = document.querySelector('.plus-btn');
    const quantityInput = document.querySelector('.qty');

    minusBtn.addEventListener('click', function() {
      if (quantityInput.value > 0) {
        quantityInput.value--;
      }
    });

    plusBtn.addEventListener('click', function() {
      quantityInput.value++;
    });
});

