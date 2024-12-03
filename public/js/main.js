import { updateMainFormStyles, closeMainForm } from './views/mainFormView.js';
import { toggleButton } from './components/burger-button.js';
import { rotateCross } from './components/close-button.js';
import { setupFormSwitching } from './components/form-switch.js';

setupFormSwitching();

document.addEventListener('click', (e) => {
    e.preventDefault();

    // Проверяем, есть ли клик по .close-button
    const closeButton = e.target.closest('.close-button');
    if (closeButton) {
        rotateCross(closeButton);
        return;
    }

    // Проверяем, есть ли клик по .burger-button
    const burgerButton = e.target.closest('.burger-button');
    if (burgerButton) {
        toggleButton(burgerButton);
    }

    // Check if click is on the login btn or register btn
    const loginBtn = e.target.closest('.header__button--login');
    const registerBtn = e.target.closest('.header__button--register');
    if(loginBtn) {
        updateMainFormStyles('login');
    }
    if(registerBtn) {
        updateMainFormStyles('register');
    }
});

// Close the form when the close button(cross) is clicked
document.querySelector('.main-form__close .close-button').addEventListener('click', closeMainForm);