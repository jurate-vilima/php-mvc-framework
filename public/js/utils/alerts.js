export function showAlert(message, classes = []) {
    const alert = document.createElement('div');
    alert.textContent = message;
    alert.classList.add('alert', ...classes);

    document.body.appendChild(alert);

    alert.offsetHeight; // Принудительная перерисовка для плавного появления
    alert.classList.add('show');

    setTimeout(() => {
        alert.classList.remove('show');
        alert.classList.add('hide');

        alert.addEventListener('transitionend', () => {
            alert.remove();
        });
    }, 5000);
}
