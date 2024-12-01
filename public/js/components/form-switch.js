export function setupFormSwitching() {
    const formContainer = document.querySelector('.main-form__container');
    formContainer.addEventListener('click', (e) => {
        const isLoginLink = e.target.closest('.form--register .form__link');
        const isRegisterLink = e.target.closest('.form--login .form__link');

        if (isLoginLink) {
            formContainer.classList.remove('shift');
        } else if (isRegisterLink) {
            formContainer.classList.add('shift');
        }
    });
}
