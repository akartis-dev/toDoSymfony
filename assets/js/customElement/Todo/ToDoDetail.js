/**
 * @Author <Akartis>
 *
 * Do it with love
 */
export default class ToDoDetail extends HTMLElement {

    constructor() {
        super();
    }

    connectedCallback() {
        this.generateHTML()
    }

    /**
     * render a html element
     */
    generateHTML() {
        this.innerHTML = `
        <div>
            <h5 class="center-align">test 1</h5>
            <div class="item">
                <h6><span class="material-icons">low_priority</span> Priorite</h6>
                <span class="new badge">Normal</span>
            </div>
            <div class="item">
                <h6><span class="material-icons">description</span> Description</h6>
                <p>Fruitcake powder icing dessert apple pie. Tart carrot cake soufflé chocolate bar pastry pastry
                soufflé marzipan tootsie roll. Jelly dragée brownie liquorice dragée sweet topping sesame
                snaps.</p>
            </div>
            <div class="item">
                <h6><span class="material-icons">today</span> Date creation</h6>
                <span>12 Oct 2020</span>
            </div>
            <div class="item">
                <h6><span class="material-icons">date_range</span> Date estimer</h6>
                <span>22 Oct 2020</span>
            </div>
        </div>
        `
    }

}
