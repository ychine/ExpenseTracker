function toggleAddModal() {
    const modal = document.getElementById('add-modal');
    const bgBlur = document.getElementById('bgblr');

    modal.classList.toggle('show');
    bgBlur.classList.toggle('show');
}

window.addEventListener('click', function (event) {
    const addModal = document.getElementById('add-modal');
    const openButton = document.getElementById('addbtn'); 
    const bgBlur = document.getElementById('bgblr');

    if (
        !addModal.contains(event.target) &&
        !openButton.contains(event.target) &&
        event.target !== openButton
    ) {
        addModal.classList.remove('show');
        bgBlur.classList.remove('show');
    }
});

window.resetForm = function() {
    const form = document.getElementById('add-form');
    const modal = document.getElementById('add-modal');
    const bgBlur = document.getElementById('bgblr');

    if (form) form.reset();
    if (modal) modal.classList.remove('show');
    if (bgBlur) bgBlur.classList.remove('show');
};

document.addEventListener('DOMContentLoaded', function () {
    const incomeRadio = document.getElementById('income');
    const expenseRadio = document.getElementById('expense');
    const descriptionSelect = document.getElementById('description');

    const incomeOptions = [
        "Salary",
        "Bonus",
        "Gift",
        "Interest",
        "Freelance"
    ];

    const expenseOptions = [
        "Utilities",
        "Housing",
        "Transportation",
        "Debt",
        "Personal Care"
    ];

    function updateDescriptionOptions(options) {
     
        descriptionSelect.innerHTML = "";

        options.forEach(option => {
            const opt = document.createElement("option");
            opt.value = option;
            opt.textContent = option;
            descriptionSelect.appendChild(opt);
        });
    }

    updateDescriptionOptions(expenseOptions);

    incomeRadio.addEventListener('change', function () {
        if (incomeRadio.checked) {
            updateDescriptionOptions(incomeOptions);
        }
    });

    expenseRadio.addEventListener('change', function () {
        if (expenseRadio.checked) {
            updateDescriptionOptions(expenseOptions);
        }
    });
});

