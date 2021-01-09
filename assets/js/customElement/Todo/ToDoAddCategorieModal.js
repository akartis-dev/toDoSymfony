/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import datepicker from "js-datepicker/src/datepicker";
import axios from 'axios'
import {ENTITIE, TODO} from "../../helper/link";
import ToDoCategorie from "./ToDoCategorie";

export default class ToDoAddCategorieModal extends HTMLElement {

    constructor() {
        super();
        this.generateHtml()
        this.handleModal()
        this.date = ''
        this.parent = document.querySelector('#jsParent')
        this.progressBar = document.querySelector('#addProgress')
    }

    generateHtml() {
        this.innerHTML = `
        <div id="modal-add" class="modal">
            <div class="modal-content">
             <div class="progress" id="addProgress" style="display: none">
                <div class="indeterminate"></div>
             </div>
              <h4>Ajout de categorie</h4>
              <p>Formulaire permettant d'ajouter un categorie avec une date limite</p>
              <div class="row">
                <div class="input-field col s12">
                  <input id="title-categorie" type="text" class="validate">
                  <label class="active" for="title-categorie">Titre</label>
                </div>
                 <div class="input-field col s12">
                 <input type="text" id="datePick">
                  <label class="active" for="datePick">Date Limite</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#!" id="close-modal" class="waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>
        `
    }

    handleModal() {
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.querySelectorAll(".modal")
            const init = M.Modal.init(el)
            const instance = el[0].M_Modal

            document.querySelector('#close-modal').addEventListener('click', () => {
                this.postData(instance)
            })

            datepicker('#datePick', {
                onHide: instance => {
                    this.date = instance.dateSelected
                }
            })
        })
    }

    async postData(modal) {
        const {title, date} = this.getModalValue()
        let html = ''
        try {
            this.progressBar.removeAttribute('style')
            const {data} = await axios.post(TODO, {title, limitAt: date, entitie: localStorage.getItem(ENTITIE)})
            this.removeNoCategorieNode()
            this.resetInputValue()
            this.parent.appendChild(this.createNewToDo(data))
            html = 'Creation avec succes'
            modal.close()
        }catch (e) {
            console.log(e)
            html = 'Une erreur s\'est produite!'
        }finally {
            M.toast({html, classes: 'rounded'});
            this.progressBar.style.display = 'none'
        }
    }

    createNewToDo({uuid}){
        const todo = new ToDoCategorie()
        todo.setAttribute('uuid', uuid)
        return todo
    }

    removeNoCategorieNode() {
        const categorie = document.querySelector('no-categorie');
        if(this.parent.childElementCount >= 1 && this.parent.firstChild === categorie){
             this.parent.removeChild(categorie)
        }
    }

    getModalValue() {
        const title = document.querySelector('#title-categorie').value
        const date = this.date
        return {title, date}
    }

    resetInputValue() {
        document.querySelector('#title-categorie').value = null
        document.querySelector('#datePick').value = null
        this.date = null
    }
}
