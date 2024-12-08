// obj - an item where to search for a particular item
// items - class name for items you want to get collection of
export function removeClassToCollection(obj, items, classToRemove) {
    obj.querySelectorAll(items).forEach((item) => {
        item.classList.remove(classToRemove);
    });
}