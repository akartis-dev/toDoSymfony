/**
 * @Author <Akartis>
 *
 * Do it with love
 */

import ToDoCategorie from "./ToDoCategorie";
import ToDoOneItem from "./ToDoOneItem";
import ToDoAddCategorieModal from "./ToDoAddCategorieModal";
import NoCategorie from "./NoCategorie";
import ToDoAddEntityModal from "./ToDoAddEntityModal";
import ToDoEntitie from "./ToDoEntitie";

customElements.define('todo-categorie', ToDoCategorie);
customElements.define('one-item', ToDoOneItem)
customElements.define('modal-add-categorie', ToDoAddCategorieModal)
customElements.define('modal-add-entity', ToDoAddEntityModal)
customElements.define('no-categorie', NoCategorie)
customElements.define('todo-entitie', ToDoEntitie)
