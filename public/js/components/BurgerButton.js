export default class BurgerButton {
    #button;

    constructor(selector) {
        this.#button = document.querySelector(selector);
    }

    toggle() {
        this.#button.classList.toggle('burger-button--active');
    }
}