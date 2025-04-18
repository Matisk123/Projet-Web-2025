<!-- Script to enable the delete button when checkbox is checked -->
document.getElementById('deleteCheckbox').addEventListener('change', function() {
    var deleteBtn = document.getElementById('deleteBtn');
    deleteBtn.disabled = !this.checked;
});
