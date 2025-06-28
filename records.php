<?php 

//records page :)

// database connection
$conn = new mysqli("localhost", "root", "", "exptrack");
if ($conn->connect_error) {
    die("Di nagconnect par" . $conn->connect_error);
    
}

$expenses = [];
$expenseQuery = "SELECT * from expenses ORDER BY date DESC";
$expenseStmt = $conn->prepare($expenseQuery);
$expenseStmt->execute();
$expenseResult = $expenseStmt->get_result();

while ($row = $expenseResult->fetch_assoc()) {
    $expenses[] = $row;
}
 
?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records | ExpenseTracker by Angela</title>
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
            <div class="backbutton upperbtn" onclick="window.location.href='./index.php'">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="titletableheader">Transactions</div>
            <div id="addbtn" class="uaddbutton upperbtn" onclick="toggleAddModal()">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M12 5V19M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            </div>
            
            <div class="tableframe">
                <table class="expense-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th style="width: 60px;"> </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenses as $expense): ?>
                            <tr>
                                <td>
                                    <?= (new DateTime($expense['Date']))->format('F d, Y — g:i A') ?>
                                </td>
                                <td class="<?= $expense['Type'] === 'Income' ? 'type-income' : 'type-expense' ?>">
                                    <?= htmlspecialchars($expense['Type']) ?>
                                </td>
                                <td><?= htmlspecialchars($expense['Description']) ?></td>
                                <td class="amtcell <?= $expense['Type'] === 'Income' ? 'amt-income' : 'amt-expense' ?>">
                                    <?= $expense['Type'] === 'Income' ? '+ ' : '- ' ?>₱<?= number_format($expense['Amount'], 2) ?>
                                </td>
                                <td class="action-cell">
                                    <a href="edit.php?id=<?= $expense['RecordID'] ?>" class="action-btn edit" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 24 24">
                                            <path d="M4 21h4.586l11.95-11.95a1.5 1.5 0 0 0 0-2.121l-2.464-2.464a1.5 1.5 0 0 0-2.121 0L4 16.414V21zM17.293 5.293l1.414 1.414-1.172 1.172-1.414-1.414 1.172-1.172z"/>
                                        </svg>
                                    </a>
                                    <a href="delete.php?id=<?= $expense['RecordID'] ?>" class="action-btn delete" title="Delete" onclick="return confirm('Are you sure you want to delete this?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 24 24">
                                            <path d="M6 7v14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6zm3 3h2v9H9v-9zm4 0h2v9h-2v-9zM15.5 4l-1-1h-5l-1 1H5v2h14V4h-3.5z"/>
                                        </svg>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>



                </table>
            </div>
            <div class="totalframe">
                Total in Wallet
                <div class="totalbox">
                    <?php 
                        $total = 0; 

                        foreach ($expenses as $expense): 
                        $total = ($expense['Type'] === 'Income') 
                            ? $total + $expense['Amount'] 
                            : $total - $expense['Amount'];
                        endforeach;

                        echo "₱" . number_format($total, 2);
                     
                    ?>
                </div>
            </div>
        </div>                        
    </div>
    
 
        

        <div id="bgblr" class="bgblr"></div>
        <div id="add-modal" class="add-modal">
            <?php include "./addmodal.php"; ?>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>