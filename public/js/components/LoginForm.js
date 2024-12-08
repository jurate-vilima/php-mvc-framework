import BaseForm from './BaseForm.js';
// import {removeClassToCollection} from '../utils/helpers.js';

export default class LoginForm extends BaseForm {
    constructor(formSelector, endpoint) {
        super(formSelector, endpoint);
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
    }

    async handleSubmit(event) {
        this.clearErrors();

        const result = await this.submitForm(event);

        if (result.success) {
        
            console.log('Login successful');
            // window.location.href = '/dashboard'; // Redirect on success
        } else {
            this.handleErrors(result.errors);
        }
    }
}