// import { updateMainFormStyles, closeMainForm } from './views/mainFormView.js';
// import { toggleButton } from './components/burger-button.js';
// import { rotateCross } from './components/close-button.js';
// import { setupFormSwitching } from './components/form-switch.js';

// const loginForm = document.querySelector('.form--login');

// setupFormSwitching();

// // document.addEventListener('DOMContentLoaded', () => {
// //     document.querySelector('.form--login form').addEventListener('submit', () => {
// //         console.log('fdfsd');
// //     });
// // });


// document.addEventListener('click', (e) => {
//    // e.preventDefault();

//     // Проверяем, есть ли клик по .close-button
//     const closeButton = e.target.closest('.close-button');
//     if (closeButton) {
//         rotateCross(closeButton);
//         return;
//     }

//     // Проверяем, есть ли клик по .burger-button
//     const burgerButton = e.target.closest('.burger-button');
//     if (burgerButton) {
//         toggleButton(burgerButton);
//     }

//     // Check if click is on the login btn or register btn
//     const loginBtn = e.target.closest('.header__button--login');
//     const registerBtn = e.target.closest('.header__button--register');
//     if(loginBtn) {
//         updateMainFormStyles('login');
//     }
//     if(registerBtn) {
//         updateMainFormStyles('register');
//     }
// });

// // Close the form when the close button(cross) is clicked
// document.querySelector('.main-form__close .close-button').addEventListener('click', closeMainForm);


// document.querySelector('.form--login form').addEventListener('submit', async function (e) {
//     e.preventDefault(); 

//     const form = e.target;
//     const formData = new FormData(form);

//     const data = Object.fromEntries(formData.entries());

//     // try {
//         const response = await fetch('http://localhost/ereg/ajax-login', {
//             method: 'POST',
//             body: new URLSearchParams([...formData]).toString(), // Convert FormData into x-www-form-urlencoded
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//         });

//         let result = await response.json();
       
//         // Clean previous errors
//         form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

//         if (result.success) {
//             // Redirect user to the dasboard
//             // window.location.href = '/dashboard'; 
//             console.log('suc');
//         } else {
//             const errors = Object.values(result.errors);
//             console.log(errors);
            
//             // Show errors if exist
//             if (errors.length) {  
//                 loginForm.querySelector('.form__message').classList.add('invalid-feedback');
//                 const errorContainer = loginForm.querySelector('.invalid-feedback');
//                 if (errorContainer) {
//                     errorContainer.textContent = errors[0];
//                 }
//             }
//         }
//     // } 
//     // catch (error) {
//     //     console.error('Error while sending form', error);
//     // }
// });





import { updateMainFormStyles, closeMainForm } from './views/mainFormView.js';
import { toggleButton } from './components/burger-button.js';
import { rotateCross } from './components/close-button.js';
import { setupFormSwitching, toggleForm } from './components/form-switch.js';

// Constants
const loginFormSelector = '.form--login';
const loginForm = document.querySelector(`${loginFormSelector} form`);
const registerFormSelector = '.form--register';
const registerForm = document.querySelector(`${registerFormSelector} form`);

const closeButtonSelector = '.main-form__close .close-button';
const headerLoginButtonSelector = '.header__button--login';
const headerRegisterButtonSelector = '.header__button--register';

// Initialize Form Switching
setupFormSwitching();

// Event Listener for Document Clicks
document.addEventListener('click', (event) => {
    const target = event.target;

    // Handle Close Button Click
    if (target.closest(closeButtonSelector)) {
        rotateCross(target);
        return;
    }

    // Handle Burger Button Click
    const burgerButton = target.closest('.burger-button');
    if (burgerButton) {
        toggleButton(burgerButton);
    }

    // Handle Header Login and Register Buttons
    if (target.closest(headerLoginButtonSelector)) {
        updateMainFormStyles('login');
    } else if (target.closest(headerRegisterButtonSelector)) {
        updateMainFormStyles('register');
    }
});

// Close the Main Form
document.querySelector(closeButtonSelector).addEventListener('click', closeMainForm);

// Submit Event for Login Form
loginForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const formData = new FormData(loginForm);
    const data = new URLSearchParams([...formData]);

    try {
        const response = await fetch('http://localhost/ereg/ajax-login', {
            method: 'POST',
            body: data.toString(),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        const result = await response.json();

        // Clear previous errors
        clearInvalidFeedback();

        if (result.success) {
            // loginForm.querySelectorAll('.form__message').classList.remove('invalid-feedback');
            removeClassToCollection(loginForm, '.form__message', 'invalid-feedback');
            console.log('Login successful');
            // Redirect or update UI
            // window.location.href = '/dashboard';
        } else {
            handleFormErrors(loginFormSelector, result.errors);
        }
    } catch (error) {
        console.error('Error while sending the form:', error);
    }
});

// Submit Event for Registration Form
registerForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const formData = new FormData(registerForm);
    const data = new URLSearchParams([...formData]);

    // try {
        const response = await fetch('http://localhost/ereg/ajax-register', {
            method: 'POST',
            body: data.toString(),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        const result = await response.json();
        console.log(result);

        // // Clear previous errors
        // clearInvalidFeedback();

        if (result.success) {
            showAlert(result.message, ['alert--success']);
            toggleForm('login');
            console.log('Login successful');

            document.querySelector('.main-form__container').addEventListener('transitionend', () => {
                // Reset all forms inside the main form
                if (registerForm) registerForm.reset();
            });
            
            // Redirect or update UI
            // window.location.href = '/dashboard';
        } else {
            handleFormErrors(registerFormSelector, result.errors);
        }
    // } catch (error) {
    //     console.error('Error while sending the form:', error);
    // }
});

// Helper Functions
function clearInvalidFeedback() {
    document.querySelectorAll('.invalid-feedback').forEach((el) => {
        el.textContent = '';
    });
}

function handleFormErrors(formSelector, errors) {
    const errorMessages = Object.values(errors);
    if (errorMessages.length > 0) {
        const errorContainer = document.querySelector(`${formSelector} .form__message`);
        errorContainer.classList.add('invalid-feedback');
        errorContainer.textContent = errorMessages[0];
    }
}

// obj - an item where to search for a particular item
// items - class name for items you want to get collection of
function removeClassToCollection(obj, items, classToRemove) {
    obj.querySelectorAll(items).forEach((item) => {
        item.classList.remove(classToRemove);
    });
}

function showAlert(message, classes = []) {
    // Создаём элемент alert
    const alert = document.createElement('div');
    alert.textContent = message;
    alert.classList.add('alert', ...classes);

    // Добавляем элемент на страницу (сразу с opacity: 0)
    document.body.appendChild(alert);

    // Принудительная перерисовка (reflow)
    alert.offsetHeight; // Чтение свойства заставляет браузер пересчитать стили

    // Добавляем класс `show` для плавного появления
    alert.classList.add('show');

    // Убираем alert через 5 секунд
    setTimeout(() => {
        alert.classList.remove('show');
        alert.classList.add('hide');

        // Удаляем элемент из DOM после завершения анимации
        alert.addEventListener('transitionend', () => {
            alert.remove();
        });
    }, 5000);
}


