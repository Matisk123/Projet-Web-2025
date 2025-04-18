document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('[data-modal-toggle="#teacher-modal"]');

    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const teacherId = event.target.dataset.id;
            const teacherLastName = event.target.dataset.lastName;
            const teacherFirstName = event.target.dataset.firstName;
            const teacherBirthDate = event.target.dataset.birthDate;
            const teacherEmail = event.target.dataset.email;

            document.getElementById('teacher-id').value = teacherId;
            document.getElementById('teacher-last-name').value = teacherLastName;
            document.getElementById('teacher-first-name').value = teacherFirstName;
            document.getElementById('teacher-birth-date').value = teacherBirthDate;
            document.getElementById('teacher-email').value = teacherEmail;

            const form = document.querySelector('#teacher-modal form');
            form.action = `/teacher/${teacherId}`;
        });
    });
});
