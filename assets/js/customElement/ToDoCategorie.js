/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import axios from 'axios';
import {TODO} from "../helper/link";
import {createElement} from "../helper/ElementCreator";
import {formatDate} from "../helper/DateHelper";

export default class ToDoCategorie extends HTMLElement {

    constructor() {
        super();
        this.list = this.getAttribute('list');
        this.id = this.getAttribute('id')
        this.btnSubmitId = "btn-submit-" + this.id
        this.textAreaId = "text-area-" + this.id
    }

    connectedCallback() {
        this.getList()
    }

    async getList() {
        try {
            const res = await axios.get(TODO + this.list)
            this.data = res['data']
            this.generateView()
            this.postNewToDo()
            // console.log(res['data'])
        } catch (e) {
            alert(e);
        }
    }

    generateView() {
        const root = createElement('div', 'col s12 m6 l4')
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
            <div class="col s3 icon">
                <span class="material-icons list-icon">list_alt</span>
            </div>
            <div class="col s9 text">
                <h5>${this.data['title']}</h5>
                <p><span class="material-icons">today</span>${formatDate(this.data['limitAt'])}</p>
            </div>
        `
        this.parent.appendChild(root);
    }

    generateContent() {
        const root = createElement('div', 'content')
        this.ulContainer = createElement('ul', 'collection with-header')
        let list = ''
        this.data['toDoLists'].map(e => {
            list += this.generateOneItem(e)
        })
        this.ulContainer.innerHTML = list;
        root.appendChild(this.ulContainer)
        this.parent.appendChild(root)
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
                            <a href="#!" class="teal-text lighten-2"><i class="material-icons">check_circle</i></a>
                            <a href="#!" class="red-text lighten-2"><i class="material-icons">delete</i></a>
                        </div>
                        ` : ""}
                    </div>
                </div>
            </li>
        `
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

    postNewToDo() {
        this.textarea = document.querySelector(`#${this.textAreaId}`);
        document.querySelector(`#${this.btnSubmitId}`).addEventListener('click', e => {
            const value = this.textarea.value
            if (value.length >= 3) {
                this.sendListToDb(value)
            }
        })
    }

    async sendListToDb(content) {
        try {
            const res = await axios.post(TODO, {content, "categorie": this.list})
            this.ulContainer.innerHTML += (this.generateOneItem(res['data']))
            this.textarea.value = ''
        } catch (e) {
            alert("Une erreur s'est produite")
        }
    }
}
