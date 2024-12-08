const formContainer = document.querySelector('.main-form__container');

export function setupFormSwitching() {
    formContainer.addEventListener('click', (event) => {
        const isLoginLink = event.target.closest('.form--register .form__link');
        const isRegisterLink = event.target.closest('.form--login .form__link');

        if (isLoginLink) {
            toggleForm('login');
        } else if (isRegisterLink) {
            toggleForm('register');
        }
    });
}

export function toggleForm(formType) {
    formContainer.classList.add('animate');
    formContainer.classList.toggle('shift', formType === 'register');

    formContainer.addEventListener('transitionend', () => {
        formContainer.classList.remove('animate');
    }, { once: true });
}
