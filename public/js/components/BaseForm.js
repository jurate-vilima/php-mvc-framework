export default class BaseForm {

    constructor(formSelector, endpoint) {
        this.form = document.querySelector(formSelector);
        this.endpoint = endpoint;

        if (!this.form) {
            throw new Error(`Form not found: ${formSelector}`);
        }
    }

    async submitForm(event) {
        event.preventDefault();

        const formData = new FormData(this.form);
        const data = new URLSearchParams([...formData]);

        try {
            const response = await fetch(this.endpoint, {
                method: 'POST',
                body: data.toString(),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            });

            return await response.json();
        } catch (error) {
            console.error('Error while sending the form:', error);
            return { success: false, error: 'Network error' };
        }
    }

    clearErrors() {
        this.form.querySelectorAll('.form__message').forEach(el => el.textContent = '');
        this.form.querySelectorAll('.invalid-feedback').forEach(el => el.classList.remove('invalid-feedback'));
    }

    clearFields() {
        this.form.reset();
    }

    handleErrors(errors) {
        const errorMessages = Object.values(errors);
        if (errorMessages.length > 0) {
            const errorContainer = this.form.querySelector('.form__message');
            if (errorContainer) {
                errorContainer.textContent = errorMessages[0];
                errorContainer.classList.add('invalid-feedback');
            }
        }
    }
}