/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import axios from 'axios';
import {ENTITIE, TODO_ENTITIE} from '../../helper/link'
import LoadingHelper from "../../helper/LoadingHelper";
export default class ToDoList {

    constructor() {
        this.parent = document.querySelector('#jsParent');
        localStorage.removeItem(ENTITIE)
    }

    getClickedEntitie() {
        const entities = document.querySelectorAll(".hero-left-card")
        entities.forEach(e => {
            e.addEventListener('click', () => {
                this.getAllCategorie(e.dataset.uuid)
            })
        })
    }

    async getAllCategorie(uuid) {
        try {
            LoadingHelper.showLoading()
            const res = await axios.get(TODO_ENTITIE + uuid);
            localStorage.setItem(ENTITIE, uuid)
            this.generateView(res.data);
        } catch (e) {
            console.log(e);
        }
        finally {
            LoadingHelper.hideLoading()
        }
    }

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
