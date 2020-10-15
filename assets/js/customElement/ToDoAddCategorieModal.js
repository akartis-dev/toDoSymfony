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
        this.date = ''
        this.parent = document.querySelector('#jsParent');
    }

    generateHtml() {
        this.innerHTML = `
        <div id="modal-add" class="modal">
            <div class="modal-content">
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

            document.querySelector('#close-modal').addEventListener('click', async () => {
                const {title, date} = this.getModalValue()
                const {data} = await axios.post(TODO, {title, limitAt: date, entitie: localStorage.getItem(ENTITIE)})
                this.removeNoCategorieNode()
                this.parent.innerHTML += `<todo-categorie uuid='${data['uuid']}' title="${data['title']}"></todo-categorie>`;
                instance.close()
            })

            datepicker('#datePick', {
                onHide: instance => {
                    this.date = instance.dateSelected
                }
            })
        })
    }

    removeNoCategorieNode() {
        const categorie = document.querySelector('no-categorie');
        this.parent.firstChild === categorie ? this.parent.removeChild(categorie) : null
    }

    getModalValue() {
        const title = document.querySelector('#title-categorie').value
        const date = this.date
        // console.log(moment(date))
        return {title, date}
    }

}
