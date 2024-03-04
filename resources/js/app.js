import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const delete_buttons = document.querySelectorAll('.btn_delete')

delete_buttons.forEach((button) => {
    button.addEventListener('click', function () {
        let project_id = button.getAttribute('data-projectid');
        let url = `${window.location.origin}/admin/project/${project_id}`;
        let title = document.getElementById('modal-title');
        let name = button.getAttribute('data-name');
        title.innerText = 'Sei sicuro di voler eliminare' + name + '?';
        let form_delete = document.getElementById('form_delete');
        form_delete.setAttribute('action', url)
    })
})