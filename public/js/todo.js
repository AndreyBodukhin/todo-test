let createTodoItem = function () {
    const firstElement = document.querySelector('ul#todo>li');
    const template = firstElement.cloneNode(true);
    firstElement.remove();
    return function (itemData) {
        template.querySelector('span.text').innerText = itemData.text;
        template.querySelector('button.upload_image').dataset.id = itemData.id;
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

document
    .getElementById('uploadImageModal')
    .addEventListener(
        'shown.bs.modal',
        (e) => {
            let itemId = e.relatedTarget.dataset.id;
            document
                .querySelector('#uploadImageForm').action = `/todo/${itemId}/upload-image`;
        });
