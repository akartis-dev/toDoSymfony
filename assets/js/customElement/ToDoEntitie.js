/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import LoadingHelper from "../helper/LoadingHelper";
import axios from "axios";
import {ENTITIE, TODO_ENTITIE} from "../helper/link";

/**
 *
 * Custom element to generate entities
 *
 */
export default class ToDoEntitie extends HTMLElement {

    constructor() {
        super();
        this.parent = document.querySelector('#jsParent')
    }

    connectedCallback(){
        this.uuid = this.getAttribute('uuid')
        this.title = this.getAttribute('title')
        this.generateHTML()
        this.addClick()
        console.log(this.uuid, this.title)
    }

    /**
     * Generate default html view
     */
    generateHTML() {
        this.innerHTML = `
        <div class="hero-left-card flex-center">
            <span class="material-icons">keyboard_arrow_right</span>
            <p>${this.title}</p>
        </div>
        `
    }

    /**
     * Add click event into object
     */
    addClick(){
        this.addEventListener('click', () => {
            this.getAllCategorie()
        })
    }

    /**
     * Fetch categorie in db
     * @returns {Promise<void>}
     */
    async getAllCategorie() {
        try {
            localStorage.removeItem(ENTITIE)
            LoadingHelper.showLoading()
            const res = await axios.get(TODO_ENTITIE + this.uuid);
            localStorage.setItem(ENTITIE, this.uuid)
            this.generateView(res.data);
        } catch (e) {
            console.log(e);
        } finally {
            LoadingHelper.hideLoading()
        }
    }

    /**
     * Append all categorie in view
     * @param categorie
     */
    generateView({categorie}) {
        let element = '';
        this.parent.innerHTML = ''
        if (categorie.length > 0) {
            categorie.map(e => {
                element += `<todo-categorie uuid='${e['uuid']}' title="${e['title']}"></todo-categorie>`;
            })
        } else {
            element = '<no-categorie></no-categorie>'
        }
        this.parent.innerHTML = element;
    }
}
