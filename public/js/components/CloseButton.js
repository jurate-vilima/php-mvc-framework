export default class CloseButton {
  constructor(selector) {
    this.element = document.querySelector(selector);
  }

  rotate() {
    this.element.classList.add('rotated');

    setTimeout(() => {
        this.element.classList.remove('rotated');
    }, 500); // Match CSS animation duration
  }

  addClickListener() {
    this.element.addEventListener('click', () => {
        this.rotate();
    });
  }
}