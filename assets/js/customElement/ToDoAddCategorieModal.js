/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import datepicker from "js-datepicker/src/datepicker";
export default class ToDoAddCategorieModal extends HTMLElement {

    constructor() {
        super();
        this.generateHtml()
        this.handleModal()
    }

    generateHtml() {
        this.innerHTML = `
        <div id="modal-add" class="modal">
            <div class="modal-content">
              <h4>Ajout de categorie</h4>
              <p>Formulaire permettant d'ajouter un categorie avec une date limite</p>
              <div class="row">
                <div class="input-field col s12">
                  <input id="title" type="text" class="validate">
                  <label class="active" for="title">Titre</label>
                </div>
                 <div class="input-field col s12">
                 <input type="text" id="datePick">
                  <label class="active" for="datePick">Date Limite</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#!" class="waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>
        `
    }

    handleModal(){
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.querySelectorAll(".modal");
            const instance = M.Modal.init(el);

           datepicker('#datePick')
        })
    }

}
