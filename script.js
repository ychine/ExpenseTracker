function toggleAddModal() {
    const modal = document.getElementById('add-modal');
    const bgBlur = document.getElementById('bgblr');

    modal.classList.toggle('show');
    bgBlur.classList.toggle('show');
}

function changeMonth(month) {
    console.log('changeMonth called with:', month);
    window.location.href = 'index.php?month=' + month;
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
        "Allowance",
        "Benefits",
        "Scholarship",
        "Refund",
        "Royalties",
        "Freelance",
        "Miscellaneous"
    ];

    const expenseOptions = [
        "Housing",
        "Utilities",
        "Transportation",
        "Debt",
        "Groceries",
        "Food & Dining",
        "Personal Care",
        "Health & Medical",
        "Entertainment",
        "Education",
        "Gifts & Donations",
        "Savings",
        "Miscellaneous"
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

