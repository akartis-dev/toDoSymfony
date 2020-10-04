/**
 * @Author <Akartis>
 *
 * Do it with love
 */
export default class ToDoCategorie extends HTMLElement {

    constructor() {
        super();
        this.innerHTML = "test";
        console.log(this.getAttribute('list'));
    }

}
