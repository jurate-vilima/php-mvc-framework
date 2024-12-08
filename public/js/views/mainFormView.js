import FormSwitch from '../components/FormSwitch.js';
import LoginForm from '../components/LoginForm.js';
import RegisterForm from '../components/RegisterForm.js';

export default class MainFormView {
    #overlay;
    #mainForm;
    #formContainer;
    #closeBtn;
    #formSwitch;
    loginForm;
    registerForm;

    constructor() {
        this.#overlay = document.querySelector('.content');
        this.#mainForm = document.querySelector('.main-form');
        this.#formContainer = document.querySelector('.main-form__container');
        this.#closeBtn = document.querySelector('.main-form .close-button');

        this.#formSwitch = new FormSwitch(this.#formContainer);
        this.loginForm = new LoginForm('.form--login form', 'http://localhost/ereg/ajax-login');
        this.registerForm = new RegisterForm('.form--register form', 'http://localhost/ereg/ajax-register', this.#formSwitch);

        this.#formSwitch.setForms(this.loginForm, this.registerForm);

        if (!this.#overlay || !this.#mainForm || !this.#formContainer) {
            throw new Error('MainFormView: Required elements not found in the DOM.');
        }
    }

    initialize() {
        this.#formSwitch.setupFormSwitching();

        // Open a form dependingly on its type- login/register
        const loginBtn = document.querySelector('.header__button--login');
        const registerBtn = document.querySelector('.header__button--register');

        loginBtn.addEventListener('click', () => {
            this.updateStyles('login');
        });
        registerBtn.addEventListener('click', () => {
            this.updateStyles('register');
        });

        this.#closeBtn.addEventListener('click', () => {
            this.closeForm();
        });
    }

    // The type of form to display ('login' or 'register').
    updateStyles(formType) {
        this.#mainForm.classList.remove('hide');
        this.#mainForm.classList.add('show');
        this.#overlay.classList.add('blur');
    
        if (formType === 'register') {
            this.#formContainer.classList.add('shift');
        } else if (formType === 'login' && this.#formContainer.classList.contains('shift')) {
            this.#formContainer.classList.remove('shift');
        }
    }

    closeForm() {    
        this.#mainForm.classList.remove('show');
        this.#mainForm.classList.add('hide');
        this.#overlay.classList.remove('blur');
    
        // Listen for the end of the transition
        this.#overlay.addEventListener('transitionend', () => {
            // Reset all forms inside the main form
            if (this.loginForm) this.loginForm.clearFields();
            if (this.registerForm) this.registerForm.clearFields();
    
            // Clear any error messages
            document.querySelectorAll('.form__message').forEach((el) => {
                el.classList.remove('invalid-feedback');
            });
        });
    }
}