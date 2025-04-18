document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('[data-modal-toggle="#cohort-modal"]');

    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const promotionId = event.target.dataset.id;
            const promotionName = event.target.dataset.name;
            const promotionDescription = event.target.dataset.description;
            const promotionStartDate = event.target.dataset.startDate;
            const promotionEndDate = event.target.dataset.endDate;

            document.getElementById('promotion-id').value = promotionId;
            document.getElementById('promotion-name').value = promotionName;
            document.getElementById('promotion-description').value = promotionDescription;
            document.getElementById('promotion-start-date').value = promotionStartDate;
            document.getElementById('promotion-end-date').value = promotionEndDate;

            const form = document.querySelector('#cohort-modal form');
            form.action = `/cohort/${promotionId}`;
        });
    });
});
