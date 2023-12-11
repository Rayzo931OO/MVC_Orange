function previewImage(event) {
    var preview = document.getElementById('preview');
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(event.target.files[0]);
    var deleteButton = document.getElementById('delete');
    deleteButton.style.display = 'block';
}


function deleteImage() {
    var image = document.getElementById('pdp');
    image.value = '';
    var preview = document.getElementById('preview');
    preview.style.display = 'none';
    preview.src = '#';
    var deleteButton = document.getElementById('delete');
    deleteButton.style.display = 'none';
}


var input = document.getElementById('pdp');
input.addEventListener('change', previewImage);
var deleteButton = document.getElementById('delete');
deleteButton.addEventListener('click', deleteImage);