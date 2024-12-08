import BaseForm from './BaseForm.js';
import { showAlert } from '../utils/alerts.js';
import FormSwitch from './FormSwitch.js';

export default class RegisterForm extends BaseForm {
    #formSwitch;

    constructor(formSelector, endpoint, formSwitch) {
        super(formSelector, endpoint);
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
        this.#formSwitch = formSwitch;
    }

    async handleSubmit(event) {
        this.clearErrors();

        const result = await this.submitForm(event);

        if (result.success) {
            showAlert(result.message, ['alert--success']);
            console.log('Registration successful');

            // Reset form after success
            // this.clearFields();
            this.#formSwitch.toggle('login', this);

            // Optional: switch to login form
            document.querySelector('.main-form__container').classList.remove('shift');
        } else {
            this.handleErrors(result.errors);
        }
    }
}
