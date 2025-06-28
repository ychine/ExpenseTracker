<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "exptrack");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: records.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM expenses WHERE RecordID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: records.php");
    exit();
}

$record = $result->fetch_assoc();

$datetime = date('Y-m-d\TH:i', strtotime($record['Date']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record | ExpenseTracker by Angela</title>
    <link rel="icon" href="./logo.svg" type="image/svg+xml">
    <link href="./styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@100..1000&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bg">
        <div class="pink">
            <svg xmlns="http://www.w3.org/2000/svg" width="931" height="721" viewBox="0 0 931 721" fill="none">
            <g filter="url(#filter0_f_3_2)">
                <path d="M739 409.5C739 475.222 643.637 528.5 526 528.5C569.5 377 192 376.722 192 311C192 245.278 287.363 192 405 192C522.637 192 612 374 739 409.5Z" fill="#AA789E"/>
                </g>
            <defs>
                <filter id="filter0_f_3_2" x="0.199997" y="0.199997" width="930.6" height="720.1" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                    <feGaussianBlur stdDeviation="95.9" result="effect1_foregroundBlur_3_2"/>
                </filter>
                </defs>
            </svg>
        </div>
        <div class="green">
            <svg xmlns="http://www.w3.org/2000/svg" width="938" height="679" viewBox="0 0 938 679" fill="none">
            <g filter="url(#filter0_f_3_3)">
                <path d="M745.5 251C745.5 316.722 659.137 486.5 541.5 486.5C423.863 486.5 192 493.222 192 427.5C192 361.778 278.363 192 396 192C513.637 192 173 553 745.5 251Z" fill="#78AA96"/>
            </g>
            <defs>
                <filter id="filter0_f_3_3" x="0.199997" y="0.199997" width="937.1" height="678.294" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                <feGaussianBlur stdDeviation="95.9" result="effect1_foregroundBlur_3_3"/>
                </filter>
            </defs>
            </svg>
        </div>
    </div>

    <div class="content">
        <div class="header">
            <div class="title">
                <img src="./logo.svg">
                <h2>ExpenseTracker</h2>
            </div>
        </div>
        <div class="wrapper">
            <div class="uppermenuholder">
                <div class="backbutton upperbtn" onclick="window.location.href='./records.php'">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="titletableheader">Edit Transaction</div>
                <div class="upperbtn" style="visibility: hidden;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div id="bgblr" class="bgblr show"></div>
    <div id="add-modal" class="add-modal show">
        <div class="add-form">
            <form id="edit-form" method="POST" action="script/updaterecord.php">
                <input type="hidden" name="record_id" value="<?= $record['RecordID'] ?>">
                <div class="addsmoothbox">
                    <div class="sbcontent">
                        <div style="display: flex; align-items: center; gap: 10px; justify-content: space-between;">
                            <h3>Edit Transaction</h3>
                            <button type="button" class="del" onclick="deleteRecord(<?= $record['RecordID'] ?>)" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 24 24">
                                    <path d="M6 7v14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6zm3 3h2v9H9v-9zm4 0h2v9h-2v-9zM15.5 4l-1-1h-5l-1 1H5v2h14V4h-3.5z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="toggleie" required>
                            <input type="radio" name="type" id="income" value="Income" <?= $record['Type'] === 'Income' ? 'checked' : '' ?>/>
                            <label class="incometoggle" for="income">Income</label>
                            <input type="radio" name="type" id="expense" value="Expense" <?= $record['Type'] === 'Expense' ? 'checked' : '' ?> />
                            <label class="expensetoggle" for="expense">Expenses</label>
                        </div>
                        <div class="Amount">
                            <label for="Amount">Amount</label>
                            PHP<input type="number" name="amount" class="amounttext" value="<?= $record['Amount'] ?>" required>
                        </div>
                        <div class="Description">
                            <label for="Description">Description</label>
                            <select id="description" name="description" class="desc" required>
                                <option value="<?= $record['Description'] ?>" selected><?= $record['Description'] ?></option>
                            </select> 
                        </div>
                        <div class="Date">
                            <label for="Date">Date</label>
                            <input type="datetime-local" name="datetime" class="dtpicker" value="<?= $datetime ?>" required>
                        </div>
                        <div class="menusfooter">
                            <button type="button" class="cancel" onclick="window.location.href='./records.php'">Cancel</button>
                            <div class="addframebg">
                                <button type="submit" class="add">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden delete form -->
    <form id="delete-form" method="POST" action="script/deleterecord.php" style="display: none;">
        <input type="hidden" name="record_id" value="<?= $record['RecordID'] ?>">
    </form>

    <script src="script.js"></script>
    <script>
        function deleteRecord(recordId) {
            if (confirm('Are you sure you want to delete this record?')) {
                document.getElementById('delete-form').submit();
            }
        }
       
        document.addEventListener('DOMContentLoaded', function () {
            const incomeRadio = document.getElementById('income');
            const expenseRadio = document.getElementById('expense');
            const descriptionSelect = document.getElementById('description');
            const currentType = '<?= $record['Type'] ?>';

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
                const currentValue = descriptionSelect.value;
                descriptionSelect.innerHTML = "";
                
                options.forEach(option => {
                    const opt = document.createElement("option");
                    opt.value = option;
                    opt.textContent = option;
                    if (option === currentValue) {
                        opt.selected = true;
                    }
                    descriptionSelect.appendChild(opt);
                });
            }

            
            if (currentType === 'Income') {
                updateDescriptionOptions(incomeOptions);
            } else {
                updateDescriptionOptions(expenseOptions);
            }

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
    </script>
</body>
</html> 