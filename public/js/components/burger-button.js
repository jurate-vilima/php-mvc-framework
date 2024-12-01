document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('.main-form .burger-button'); 

    // if (menuToggle) {
    //   menuToggle.classList.add('menu-toggle--active'); 
    // }
});

export function toggleButton(element) {
    element.classList.toggle('burger-button--active');
}
  