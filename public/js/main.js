// import BurgerButton from './components/BurgerButton.js';
import CloseButton from './components/CloseButton.js';
import MainFormView from './views/MainFormView.js';
import LoginForm from './components/LoginForm.js';
import RegisterForm from './components/RegisterForm.js';
// import FormSwitch from './components/FormSwitch.js';

document.addEventListener('DOMContentLoaded', () => {
    const mainFormView = new MainFormView();
    const closeButton = new CloseButton('.close-button');

    // Add animation to a close- cross button
    closeButton.addClickListener();

    // Initialize main form functionality
    mainFormView.initialize();
});