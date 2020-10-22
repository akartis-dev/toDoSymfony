/**
 * @Author <Akartis>
 *
 * Do it with love
 */

import ToDoCategorie from "./Todo/ToDoCategorie";
import ToDoOneItem from "./Todo/ToDoOneItem";
import ToDoAddCategorieModal from "./Todo/ToDoAddCategorieModal";
import NoCategorie from "./NoCategorie";
import ToDoAddEntityModal from "./Todo/ToDoAddEntityModal";
import ToDoEntitie from "./Todo/ToDoEntitie";
import ToDoDetail from "./Todo/ToDoDetail";

customElements.define('todo-categorie', ToDoCategorie);
customElements.define('one-item', ToDoOneItem)
customElements.define('modal-add-categorie', ToDoAddCategorieModal)
customElements.define('modal-add-entity', ToDoAddEntityModal)
customElements.define('no-categorie', NoCategorie)
customElements.define('todo-entitie', ToDoEntitie)
customElements.define('todo-detail', ToDoDetail)
