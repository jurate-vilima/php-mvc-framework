export function handleFormErrors(formSelector, errors) {
    const errorMessages = Object.values(errors);
    if (errorMessages.length > 0) {
        const errorContainer = document.querySelector(`${formSelector} .form__message`);
        errorContainer.classList.add('invalid-feedback');
        errorContainer.textContent = errorMessages[0]; // Отображаем первую ошибку
    }
}
