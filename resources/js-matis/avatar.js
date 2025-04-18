/* function previewImage(event) {
    const input = event.target;
    const preview = input.closest('.image-input').querySelector('.image-input-preview');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.style.backgroundImage = 'url(' + e.target.result + ')';
        };
        reader.readAsDataURL(file);
    }
}

function resetImage(event) {
    event.stopPropagation();
    const imageInput = document.getElementById('avatarInput');
    imageInput.value = ''; // reset le champ
    const preview = document.querySelector('.image-input-preview');
    preview.style.backgroundImage = 'url("{{ asset(auth()->user()->avatar ?? 'metronic/media/avatars/blank.png') }}")';
}*/
