
<?php
//EXERCICE1
echo '<div class="#e3f2fd blue lighten-5 col s12"
<h2> Table of 3</h2>';
for($i=1;$i<=10;$i++){
    $result= $i * 3;
    echo '<p> '.$i.'x 3 =';
    echo $result;
}
echo '</div>';
echo '<hr>';
// EXERCISE 2
if(!empty($_POST["nomber"])){ 

    $multipier = $_POST["nomber"];

    if(!empty($multipier)) {

        $calcul = '';

        for($row=1; $row <= 10; $row++){ 

            $calcul .= '<tr><td>'.$multipier.' x '.$row.' = '.$multipier * $row.'</td></tr>';

        }

        $result_nomber = '

            <br><br>
            Table of '.$multipier.'
            <br><br>
            <table border =\"1\" style="border-collapse:collapse">
            '.$calcul.'
            </table>
        
        ';

    }

}

// EXERCISE 3
if(!empty($_POST['checked'])){

    $checked = $_POST['checked'];
    $n = count($checked);
    $result_checked = '<div class="result-checked">';

    for($i=0;$i<$n;$i++){

        $result_checked .= '<h3>Table of '.$checked[$i].'</h3>';

        for($j=1;$j<=10;$j++){

            $step = $checked[$i] * $j;
            $result_checked .= '<p>'.$checked[$i].' x '.$j.' = '.$step.'</p>';

        }

    }

    $result_checked .= '</div>';

}

// EXERCISE 4
if(!empty($_POST['test'])){

    $choice = $_POST['test'];
    $random = rand(1,10);
    $question = getQuestion($choice, $random);

}

if(!empty($_POST['validate'])){

    $choice         = $_POST['choice'];
    $random         = $_POST['random'];
    $response       = $_POST['response'];
    $result_test    = getQuestion($choice, $random);

    if($response == ($choice * $random))
        $result_test .= '<p>Bravo</p>';
    else 
        $result_test .= '<p>C\'You lost</p>';

}
/////////EXERCISE 5

if(!empty($_POST['game'])){

    $choice = $_POST["game"];
    $response_arr='';
    $result_arr='';
    $random= '';
    $questions = '<br><br><form method="post" action="index.php">';


    for($i=1 ; $i<=5;$i++){

        $random = rand(1,10);
        $questions .= getQuestions($choice, $random);
        $result_arr.= $random * $choice;

    }

    $questions .= '<input type="submit" value="check" name="check"/> </form>';

}
if(!empty($_POST['check'])){

   // var_dump($_POST);

    
    $choice         = $_POST['choice'];
    $random_arr       = $_POST['random'];
    $response_arr     = $_POST['response'];
    //$result_arr   = getQuestions($choice, $random);
    $score= 0;
    for($i=0; $i<5; $i++){
        if($response_arr[$i] == $choice * $random_arr[$i]){

            $score += 1;  
        }
    
        
    }

    //echo '<p> Your score is '.$score.'</p>';
   
    //$result_arr .= '<p> Your score is '.$score.'</p>';

}




/***********
 * 
 * FUNCTIONS
 */

function createSelect ($name){

    $select = '<select name="'.$name.'"> <option value="" selected>Choisir Table</option>';

    for ($i=1; $i <= 10; $i++) {

        $select .= '<option value="'.$i.'">Table of '.$i.'</option>';

    }

    return $select .= '</select>';

}

function createCheckboxes($name) {

    $checkboxes = '';

    for($i=1; $i<=10;$i++){
       
       $checkboxes .= '<input type="checkbox" name="'.$name.'[]" value="'.$i.'"/>Table of '.$i.' <br> ';
        
    }

    $checkboxes .= '<br>';

    return $checkboxes;

}

function getQuestion($choice, $random) {

    $question = '

        <br><br>
        <form method="post" action="index.php">
            write the answer of '.$choice.' x '.$random.' 
            <input type="text" name="response" placeholder="?"/>
            <input type="hidden" name="random" value="'.$random.'">
            <input type="hidden" name="choice" value="'.$choice.'">
            <input type="submit" value="validate" name="validate"/>
        </form>';

    return $question;

}

function getQuestions($choice, $random) {

    $questions = '
        
         '.$choice.' x '.$random.' 
        <input type="text" name="response[]" placeholder="?"/>
        <input type="hidden" name="random[]" value="'.$random.'">
        <input type="hidden" name="choice" value="'.$choice.'">
       
    ';

    return $questions;

}




?><html>
    <head> 
       <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">-->
        <link rel="stylesheet" href="main.css"/>
    </head>
    <body>
    <div class="row">
        <div class=" #e3f2fd blue lighten-5 col s12">
            <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <?php echo createSelect('nomber'); ?>
                <input type="submit" value="submit" name="submit">
                <?php if(isset($result_nomber)) echo $result_nomber; ?>
            </form>
            <hr> 
        </div>

        <div class="#90caf9 blue lighten-3 col s12">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <?php echo createCheckboxes('checked'); ?>
                <input type="submit" name="submit" value="submit">
                <?php if(isset($result_checked)) echo $result_checked; ?>
            </form>
            <hr> 
        </div>

        <div class="#64b5f6 blue lighten-2 col s12">

            <h2>Testing your self</h2> 
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <?php echo createSelect('test'); ?>
                <input type="submit" value="submit" name="submit">
                <?php if(isset($question)) echo $question; ?>
                <?php if(isset($result_test)) echo $result_test; ?>
            </form>
            <hr>
        </div>

        <div class="#42a5f5 blue lighten-1 col s12">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <h2> Game with us </h2>
                <?php echo createSelect('game'); ?>
                <input type="submit" value="submit" name="submit">
                <?php if(isset($questions)) echo $questions; ?>
                <?php if(isset($score)) echo '<p> Your score is '.$score.'</p>'; ?> 
            </form>
            <hr>
        </div>
    </div>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    </body>
</html>
