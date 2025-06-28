<?php 

//landing page :)

// database connection
$conn = new mysqli("localhost", "root", "", "exptrack");
if ($conn->connect_error) {
    die("Di nagconnect par" . $conn->connect_error);
    
}

$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

$expenses = [];
$expenseQuery = "SELECT * from expenses ORDER BY date DESC";
$expenseStmt = $conn->prepare($expenseQuery);
$expenseStmt->execute();
$expenseResult = $expenseStmt->get_result();

while ($row = $expenseResult->fetch_assoc()) {
    $expenses[] = $row;
}
 
$groupedExpenses = [];
foreach ($expenses as $expense) {
    $monthKey = date('Y-m', strtotime($expense['Date']));
    $groupedExpenses[$monthKey][] = $expense;
}

$currentExpenses = isset($groupedExpenses[$selectedMonth]) ? $groupedExpenses[$selectedMonth] : [];

$currentDate = DateTime::createFromFormat('Y-m', $selectedMonth);
$prevMonth = (clone $currentDate)->modify('-1 month')->format('Y-m');
$nextMonth = (clone $currentDate)->modify('+1 month')->format('Y-m');

$availableMonths = array_keys($groupedExpenses);
sort($availableMonths);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpenseTracker by Angela</title>
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
            
            <h4>by Angela Sapaula</h4>
        </div>
    
        <div class="rowdiv">
            <div class="smoothbox">
                <h2>Dashboard</h2>
                <div class="month-navigation">
                    <button class="nav-arrow" onclick="changeMonth('<?= $prevMonth ?>')" title="Previous Month (<?= $prevMonth ?>)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    
                    <h3><?= date('F Y', strtotime($selectedMonth . '-01')) ?></h3>
                    
                    <button class="nav-arrow" onclick="changeMonth('<?= $nextMonth ?>')" title="Next Month (<?= $nextMonth ?>)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                
                <div class="totalie">
                    <?php
                        $totalincome = 0; 
                        $totalexpenses = 0; 

                        foreach ($currentExpenses as $expense):
                            if ($expense['Type'] === 'Income') {
                                $totalincome += $expense['Amount'];
                            } else {
                                $totalexpenses += $expense['Amount'];
                            }
                        endforeach;
                        ?>
                        <div class="dashbdescriptor">
                            <span>Total Income:</span>
                            <h5 class="value vgreen">
                                <?php echo nl2br(number_format($totalincome, 2)); ?>
                            </h5>
                        </div>

                        <div class="dashbdescriptor">
                            <span>Total Expenses:</span>
                            <h5 class="value red">
                                <?php echo nl2br("-". number_format($totalexpenses, 2)); ?>
                            </h5>
                        </div>
                    
                </div>
                <br>
                <div class="baldesc">
                    Total Balance in Wallet:
                
                    <?php 
                        $total = 0; 

                        foreach ($expenses as $expense): 
                        $total = ($expense['Type'] === 'Income') 
                            ? $total + $expense['Amount'] 
                            : $total - $expense['Amount'];
                        endforeach;
                        ?>
                    <span class="totalcumulated">  
                        <?php 
                        echo nl2br("\nPhp " . number_format($total, 2));
                        ?>
                    </span> 
               </div>

            </div>

            <div class="menubtns">
                <button id="addbtn" class="addbtn" onclick="toggleAddModal()">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                        <rect x="16" y="6" width="4" height="24" rx="2" fill="#FFF"/>
                        <rect x="6" y="16" width="24" height="4" rx="2" fill="#FFF"/>
                    </svg>
                </button>

                <button id="recordbtn" class="recordbtn" onclick="window.location.href='./records.php'">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <rect x="8" y="6" width="20" height="24" rx="2" fill="#FFF" stroke="#000" stroke-width="2"/>
                    <rect x="12" y="10" width="12" height="2" rx="1" fill="#000"/>
                    <rect x="12" y="15" width="12" height="2" rx="1" fill="#000"/>
                    <rect x="12" y="20" width="8" height="2" rx="1" fill="#000"/>
                    </svg>
                </button>


            </div>
        </div>

        <div id="bgblr" class="bgblr"></div>
        <div id="add-modal" class="add-modal">
            <?php include "./addmodal.php"; ?>
        </div>
    </div>


    

    
    <script src="./script.js"></script>
</body>

</html>







