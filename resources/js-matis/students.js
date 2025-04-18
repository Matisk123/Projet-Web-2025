document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('[data-modal-toggle="#student-modal"]');

    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const studentId = event.target.dataset.id;
            const studentLastName = event.target.dataset.lastName;
            const studentFirstName = event.target.dataset.firstName;
            const studentBirthDate = event.target.dataset.birthDate;
            const studentEmail = event.target.dataset.email;

            document.getElementById('student-id').value = studentId;
            document.getElementById('student-last-name').value = studentLastName;
            document.getElementById('student-first-name').value = studentFirstName;
            document.getElementById('student-birth-date').value = studentBirthDate;
            document.getElementById('student-email').value = studentEmail;

            const form = document.querySelector('#student-modal form');
            form.action = `/students/${studentId}`;
        });
    });
});
