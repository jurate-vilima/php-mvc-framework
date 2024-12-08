import {removeClassToCollection} from '../utils/helpers.js';

export default class FormSwitch {
    #formContainer;
    #loginForm;
    #registerForm;

    constructor(formContainer) {
        this.#formContainer = formContainer;
    }

    setForms(loginForm, registerForm) {
        this.#loginForm = loginForm;
        this.#registerForm = registerForm;
    }

    toggle(formType, form) {
        this.#formContainer.classList.add('animate');
        this.#formContainer.classList.toggle('shift', formType === 'register');
    
        this.#formContainer.addEventListener('transitionend', () => {
            form.clearErrors();
            form.clearFields();
            this.#formContainer.classList.remove('animate');
        }, { once: true });
    }

    setupFormSwitching() {
        this.#formContainer.addEventListener('click', (event) => {
            const isLoginLink = event.target.closest('.form--register .form__link');
            const isRegisterLink = event.target.closest('.form--login .form__link');
    
            if (isLoginLink) {
                this.toggle('login', this.#registerForm);
            } else if (isRegisterLink) {
                this.toggle('register', this.#loginForm);
            }
        });
    }
}
