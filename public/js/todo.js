let createTodoItem = function () {
    const firstElement = document.querySelector('ul#todo>li');
    const template = firstElement.cloneNode(true);
    firstElement.remove();
    return function (itemData) {
        template.dataset.id = itemData.id;
        template.querySelector('span.text').innerText = itemData.text;
        let deleteForm = template.querySelector('form.delete_item');
        deleteForm.action = deleteForm.action.replace('item_id', itemData.id);
        document.querySelector('ul#todo').prepend(template.cloneNode(true));
    }
}();

function todoFormSubmitHandler() {
    let formData = new FormData(document.querySelector('form#todo'));
    fetch('/todo', {
        body: formData,
        method: 'post',
        headers: {
            Accept: 'application/json'
        }
    }).then(function (response) {
        if (response.ok) {
            return response.json();
        }
    }).then(createTodoItem);
}

function todoCheckboxHandler(checkbox) {
    let id = checkbox.closest('li').dataset.id;
    let action = checkbox.checked ? 'done' : 'undone';
    fetch(`/todo/${id}/${action}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
        }
    });
}

document
    .getElementById('uploadImageModal')
    .addEventListener(
        'shown.bs.modal',
        (e) => {
            let itemId = e.relatedTarget.closest('li').dataset.id;
            document
                .querySelector('#uploadImageForm').action = `/todo/${itemId}/upload-image`;
        });
