const formContainer = document.querySelector('.main-form__container');

export function setupFormSwitching() {
    formContainer.addEventListener('click', (e) => {
        const isLoginLink = e.target.closest('.form--register .form__link');
        const isRegisterLink = e.target.closest('.form--login .form__link');

        if (isLoginLink) {
            formContainer.classList.add('animate');
            formContainer.classList.remove('shift');

            formContainer.addEventListener('transitionend', () => {
                formContainer.classList.remove('animate');
            });
            
        } else if (isRegisterLink) {
            formContainer.classList.add('animate');
            formContainer.classList.add('shift');

            formContainer.addEventListener('transitionend', () => {
                formContainer.classList.remove('animate');
            });
        }
    });
}
