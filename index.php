<?php 

//landing page :)
// database connection
$conn = new mysqli("localhost", "root", "", "exptrack");
if ($conn->connect_error) {
    die("Di nagconnect par" . $conn->connect_error);
    
}

 
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
                <h2>Expense Tracker</h2>
            </div>
            
            <h4>by Angela Sapaula</h4>
        </div>
    
        <div class="smoothbox">
            

        </div>

        <button id="addbtn" class="addbtn" onclick="toggleAddModal()">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <rect x="16" y="6" width="4" height="24" rx="2" fill="#FFF"/>
                <rect x="6" y="16" width="24" height="4" rx="2" fill="#FFF"/>
            </svg>
        </button>

        <div id="bgblr" class="bgblr"></div>
        <div id="add-modal" class="add-modal">
            <?php include "./addmodal.php"; ?>
        </div>
    </div>


    <script src="./script.js"></script>




</body>

</html>







