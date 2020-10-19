/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import axios from 'axios'
import {TODO_ENTITIE} from "../helper/link";
import ToDoEntitie from "./ToDoEntitie";

export default class ToDoAddEntityModal extends HTMLElement {

    constructor() {
        super();
        this.generateModal()
        this.handleModal()
        this.parent = document.querySelector("#left-col-item")
        this.load = document.querySelector("#entitie-load")
    }

    /**
     * Generate modal html
     */
    generateModal() {
        this.innerHTML = `
        <div id="modal-entity" class="modal">
            <div class="modal-content">
              <h4>Ajouter une entite</h4>
              <div class="input-field hero-margin-y-3">
                  <input placeholder="Nom du tache" id="entite" type="text" class="validate">
                  <label for="first_name">Titre</label>
              </div>
            </div>
             <div class="progress" style="display: none" id="entitie-load">
                <div class="indeterminate"></div>
             no </div>
            <div class="modal-footer">
              <a href="#!" id="closeEntity" class="waves-effect waves-green btn-flat">Ajouter</a>
            </div>
        </div>
        `
    }

    /**
     * Handle modal close to post data
     */
    handleModal() {
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.querySelectorAll(".modal")
            const instance = el[1].M_Modal

            document.querySelector('#closeEntity').addEventListener('click', () => {
                this.postData(instance);
            })
        })
    }

    /**
     * Post new Data in db
     * @returns {Promise<void>}
     */
    async postData(instance) {
        this.input = document.querySelector('#entite')
        const title = this.input.value
        try {
            this.load.style.display = 'block'
            const res = await axios.post(TODO_ENTITIE, {title})
            this.generateEntitie(res.data)
            instance.close()
        } catch (e) {
            console.log(e)
        } finally {
            this.load.style.display = 'none'
        }
    }

    /**
     * Generate a new Entitie and append in parent node
     * @param uuid
     * @param title
     */
    generateEntitie({uuid, title}) {
        const entitie = new ToDoEntitie();
        entitie.setAttribute('uuid', uuid)
        entitie.setAttribute('title', title)
        this.parent.prepend(entitie);
    }
}
