import { clearAllStylesExceptBase } from '../utils.js';

const overlay = document.querySelector('.content');
const mainForm = document.querySelector('.main-form');
const formContainer = document.querySelector('.main-form__container');

document.addEventListener('DOMContentLoaded', () => {
    mainForm.classList.add('hide');
});

export const updateMainFormStyles = (form) => {
    mainForm.classList.remove('hide');
    mainForm.classList.add('show');
    overlay.classList.add('blur');

    if(form == 'register') {
        formContainer.classList.add('shift');
    }
};

export const closeMainForm = () => {
    mainForm.classList.remove('show');
    mainForm.classList.add('hide');
    overlay.classList.remove('blur');

    // mainForm.addEventListener('transitionend', () => {
    //     // if(formContainer.classList.contains(''))
    //     clearAllStylesExceptBase(formContainer, '.main-form__container');
    // });
};