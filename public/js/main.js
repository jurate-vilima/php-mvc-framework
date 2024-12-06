import { updateMainFormStyles, closeMainForm } from './views/mainFormView.js';
import { toggleButton } from './components/burger-button.js';
import { rotateCross } from './components/close-button.js';
import { setupFormSwitching } from './components/form-switch.js';

const loginForm = document.querySelector('.form--login');

setupFormSwitching();

// document.addEventListener('DOMContentLoaded', () => {
//     document.querySelector('.form--login form').addEventListener('submit', () => {
//         console.log('fdfsd');
//     });
// });


document.addEventListener('click', (e) => {
   // e.preventDefault();

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


document.querySelector('.form--login form').addEventListener('submit', async function (e) {
    e.preventDefault(); 

    const form = e.target;
    const formData = new FormData(form);

    const data = Object.fromEntries(formData.entries());
    console.log(data);

    // try {
        const response = await fetch('http://localhost/ereg/ajax-login', {
            method: 'POST',
            body: new URLSearchParams([...formData]).toString(), // Convert FormData into x-www-form-urlencoded
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        let result = await response.json();
        // result = Object.entries(result);
        console.log(result);
       
        // Clean previous errors
        form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

        if (result.success) {
            // Redirect user to the dasboard
            // window.location.href = '/dashboard'; 
            console.log('suc');
        } else {
            const errors = Object.values(result.errors);
            console.log(errors);
            
            // Show errors if exist
            if (errors.length) {
                console.log('ffdg');
  
                loginForm.querySelector('.form__message').classList.add('invalid-feedback');
                const errorContainer = loginForm.querySelector('.invalid-feedback');
                if (errorContainer) {
                    errorContainer.textContent = errors[0];
                }
            }
        }
    // } 
    // catch (error) {
    //     console.error('Error while sending form', error);
    // }
});