export function rotateCross(element) {
    element.classList.add('rotated');
  
    // Убираем класс после завершения вращения
    setTimeout(() => {
      element.classList.remove('rotated');
    }, 500); // Время должно совпадать с длительностью анимации (0.5s)
}
  