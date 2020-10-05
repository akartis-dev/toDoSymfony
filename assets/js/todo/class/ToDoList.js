/**
 * @Author <Akartis>
 *
 * Do it with love
 */
import axios from 'axios';
import {TODO} from '../../helper/link'

export default class ToDoList {

    constructor() {
        this.parent = document.querySelector('#jsParent');
    }

    async getAllCategorie() {
        try {
            const res = await axios.get(TODO);
            this.generateView(res);
        } catch (e) {
            console.log(e);
        }
    }

    generateView({data}) {
        let element = '';
        data.map(e => {
            element += `<todo-categorie list='${e['uuid']}' title="${e['title']}"></todo-categorie>`;
        })
        this.parent.innerHTML = element;
    }

}
