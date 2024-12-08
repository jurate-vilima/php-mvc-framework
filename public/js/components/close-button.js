export function rotateCross(element) {
  element.classList.add('rotated');

  // Remove the rotation class after animation completes
  setTimeout(() => {
      element.classList.remove('rotated');
  }, 500); // Ensure duration matches CSS animation
}
