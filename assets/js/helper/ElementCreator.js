/**
 * @Author <Akartis>
 *
 * Do it with love
 */

export const createElement = (e, classes) => {
    const element = document.createElement(e);
    classes.split(" ").forEach(e => {
        element.classList.add(e)
    })
    return element;
}
