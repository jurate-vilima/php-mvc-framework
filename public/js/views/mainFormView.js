const overlay = document.querySelector('.content');
const mainForm = document.querySelector('.main-form');
const formContainer = document.querySelector('.main-form__container');

export function updateMainFormStyles(formType) {
    mainForm.classList.remove('hide');
    mainForm.classList.add('show');
    overlay.classList.add('blur');

    if (formType === 'register') {
        formContainer.classList.add('shift');
    } else if (formType === 'login' && formContainer.classList.contains('shift')) {
        formContainer.classList.remove('shift');
    }
}

export function closeMainForm() {
    const mainForm = document.querySelector('.main-form');
    const overlay = document.querySelector('.content');
    const loginForm = document.querySelector('.form--login form');
    const registerForm = document.querySelector('.form--register form');

    mainForm.classList.remove('show');
    mainForm.classList.add('hide');
    overlay.classList.remove('blur');

    // Listen for the end of the transition
    overlay.addEventListener('transitionend', () => {
        // Reset all forms inside the main form
        if (loginForm) loginForm.reset();
        if (registerForm) registerForm.reset();

        // Clear any error messages
        document.querySelectorAll('.form__message').forEach((el) => {
            el.classList.remove('invalid-feedback');
        });
    });
}