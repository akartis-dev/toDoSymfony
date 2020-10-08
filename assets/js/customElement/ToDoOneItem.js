/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import axios from 'axios';
import {TODO} from "../helper/link";

export default class ToDoOneItem extends HTMLElement {

    constructor() {
        super();
        this.data = JSON.parse(this.getAttribute('content'))
        this.successId = `success-${this.data['uuid']}`
        this.deleteId = `delete-${this.data['uuid']}`
    }

    connectedCallback() {
        this.innerHTML = this.generateOneItem(this.data)
        this.successAction()
        this.deleteAction()
    }

    generateOneItem(e) {
        return `
            <li class="collection-item item">
                <div class="hero-todo-bar"></div>
                <div>
                    <div class="row">
                        <div class="col ${e['isDone'] ? 's12' : 's10'}">
                            ${e['content']}
                        </div>
                        ${!e['isDone'] ? `
                        <div class="col s2">
                            <a href="#!" class="teal-text lighten-2" id="${this.successId}"><i class="material-icons">check_circle</i></a>
                            <a href="#!" class="red-text lighten-2" id="${this.deleteId}"><i class="material-icons">delete</i></a>
                        </div>
                        ` : ""}
                    </div>
                </div>
            </li>
        `
    }

    successAction() {
        const a = document.querySelector(`#${this.successId}`)
        if (a !== null) {
            a.addEventListener('click', async e => {
                const res = await axios.put(`${TODO}${this.data['uuid']}`, {'isDone': true})
                console.log(res);
            })
        }
    }

    deleteAction() {
        const a = document.querySelector(`#${this.deleteId}`)
        if (a !== null) {
            a.addEventListener('click', async e => {
                const res = await axios.delete(`${TODO}${this.data['uuid']}`)
                console.log(res);
            })
        }
    }

}
