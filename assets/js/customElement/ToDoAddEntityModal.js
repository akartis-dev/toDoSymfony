/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import axios from 'axios'
import {TODO_ENTITIE} from "../helper/link";

export default class ToDoAddEntityModal extends HTMLElement {

    constructor() {
        super();
        this.generateModal()
        this.handleModal()
        this.parent = document.querySelector("#left-col")
    }

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
            <div class="modal-footer">
              <a href="#!" id="closeEntity" class="waves-effect waves-green btn-flat">Ajouter</a>
            </div>
        </div>
        `
    }

    handleModal() {
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.querySelectorAll(".modal")
            const instance = el[1].M_Modal

            document.querySelector('#closeEntity').addEventListener('click', () => {
                instance.close()
            })
        })
    }

    async postData() {
        this.input = document.querySelector('#entite')
        const title = this.input.value
        try {
            await axios.post(TODO_ENTITIE, {title})
        } catch (e) {

        } finally {

        }
    }
}
