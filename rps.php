<?php
session_start();

    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }
    
    $human_images = [
        'rock' => 'rck-l.gif',
        'paper' => 'paper-l.gif',
        'scissors' => 'sciss-l.gif'
    ];
    
    $computer_images = [
        'rock' => 'rck-r.gif',
        'paper' => 'paper-r.gif',
        'scissors' => 'sciss-r.gif'
    ];
    
    $userChoice = $computerChoice = $result = "";
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['choice'])) {
            $userChoice = $_POST['choice'];
            $computerChoice = array_rand($computer_images); 
    
          
            if ($userChoice === $computerChoice) {
                $result = "It's a draw!";
            } elseif (
                ($userChoice === 'rock' && $computerChoice === 'scissors') ||
                ($userChoice === 'scissors' && $computerChoice === 'paper') ||
                ($userChoice=== 'paper' && $computerChoice === 'rock')
            ) {
                $result = "You win!";
                $_SESSION['score']++; 
            } else {
                $result = "Computer wins!";
            }
        }
    
        if (isset($_POST['reset'])) {
            session_destroy(); 
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit();
        }
    }

    ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jack en Poy Game</title>
    <link rel="stylesheet" href="rps1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>

    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>"   method="post">

     
    <table>
            <tr>
                <th colspan = "2">Rock Paper Scissor Game</th>
            </tr>

            <tr class="picInsert">
                <th>
                      
               <?php if (!empty($userChoice)): ?>
                   <img src="<?php echo $human_images[$userChoice]; ?>" >
                   <br>
               <?php endif; ?>


                </th>
            
             
           
           <th>
           <?php if (!empty($computerChoice)): ?>
                   <img src="<?php echo $computer_images[$computerChoice]; ?>" >
                   <br>
                   
               <?php endif; ?>
           </th>
                 
       </tr>

       <tr>
           <th>Human Player</th>
           <th>Computer Player</th>
       </tr>

       <tr>
           <th colspan="2">
               <input type="radio" id="rock" name="choice" value="rock" >
               <label for="rock">Rock</label>

               <input type="radio" id="paper" name="choice" value="paper">
               <label for="paper">Paper</label>

               <input type="radio" id="scissors" name="choice" value="scissors">
               <label for="scissors">Scissors</label> <br> <br>

               <strong>Your score is:  </strong> <?php echo $_SESSION['score']; ?><br>
           <strong>Result:</strong> <?php echo $result; ?>


           </th>
          
         

           

        
       </tr>
   

      
       <tr>
           <th colspan="2">
               <button type="submit">Play</button>
               <button type="submit" name="reset">End</button>
           </th>
       </tr>
        </table>


    </form>
    
</body>
</html>