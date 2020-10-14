/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import axios from 'axios';
import {TODO, TODO_LIST} from "../helper/link";
import {createElement} from "../helper/ElementCreator";
import {formatDate} from "../helper/DateHelper";

export default class ToDoCategorie extends HTMLElement {

    constructor() {
        super();
        this.uuid = this.getAttribute('uuid');
        this.btnSubmitId = "btn-submit-" + this.uuid
        this.textAreaId = "text-area-" + this.uuid
    }

    connectedCallback() {
        this.getList()
    }

    async getList() {
        try {
            const res = await axios.get(TODO + this.uuid)
            this.data = res['data']
            this.generateView()
            this.postNewToDoList()
        } catch (e) {
            alert(e);
        }
    }

    generateView() {
        const root = createElement('div', 'col s12 m6 l6')
        this.parent = createElement('div', 'hero-todo-card')
        this.generateHeaderCard()
        this.generateContent()
        this.generateFooter()
        root.appendChild(this.parent);
        this.appendChild(root);
    }

    generateHeaderCard() {
        const root = createElement('div', 'header row hero-margin-0')
        root.innerHTML = `
            <div class="col s12 text">
                <h5>${this.data['title']}</h5>
                <p><span class="material-icons">today</span>${formatDate(this.data['limitAt'])}</p>
            </div>
        `
        this.parent.appendChild(root);
    }

    generateContent() {
        const root = createElement('div', 'content')
        this.ulContainer = createElement('ul', 'collection with-header')
        this.data['toDoLists'].map(e => {
            this.ulContainer.innerHTML += `<one-item content='${JSON.stringify(e)}'></one-item>`
        })
        root.appendChild(this.ulContainer)
        this.parent.appendChild(root)
    }

    generateFooter() {
        const div = createElement('div', 'footer')
        div.innerHTML = `
            <div class="input-field">
                <textarea id="${this.textAreaId}" class="materialize-textarea"></textarea>
                <label for="${this.textAreaId}">Nouvelle tache</label>
                  <button class="btn waves-effect waves-light" id="${this.btnSubmitId}">
                    <i class="material-icons">send</i>
                  </button>
            </div>
            <p><span class="material-icons">schedule</span> Creer le: ${formatDate(this.data['createdAt'])}</p>
        `
        this.parent.appendChild(div);
    }

    postNewToDoList() {
        this.textarea = document.querySelector(`#${this.textAreaId}`);
        document.querySelector(`#${this.btnSubmitId}`).addEventListener('click', e => {
            const value = this.textarea.value
            if (value.length >= 3) {
                this.sendToDoListInDb(value)
            }
        })
    }

    async sendToDoListInDb(content) {
        try {
            const res = await axios.post(TODO_LIST, {content, "categorie": this.uuid})
            this.ulContainer.innerHTML += `<one-item content='${JSON.stringify(res['data'])}'></one-item>`
            this.textarea.value = ''
        } catch (e) {
            alert("Une erreur s'est produite")
        }
    }

}
