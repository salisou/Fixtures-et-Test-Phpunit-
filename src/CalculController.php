<?php 

require_once "./Calculator.php";

//Se il pulsante di invio è stato premuto 
if (is_numeric($_POST['number1']) && is_numeric($_POST['number2'])) {
    $calculator = new \AppendIterator;

    //Controlla i valori numerici
    if ($_POST['operation'] == 'plus') 
    {
        $total = $calculato->add($_POST['number1'], $_POST['number2']); 
    } 
    else if ($_POST['opration'] == 'minus') 
    {
        $total = $calculator->subtract($_POST['number1'], $_POST['number2']);
    }
    else if ($_POST['operation'] == 'times') 
    {
        $total = $calculator->multiply($_POST['number1'], $_POST['number2']);
    }
    else if ($_POST['operation'] == 'divided by')
    {
        $total = $calculator->divide($_POST['number1'], $_POST['number2']); 
    }
    
    echo "<h1>{$_POST['number1']} {$_POST['operation']} {$_POST['number2']} equals {$total}</h1>";
    
} else {
    echo 'I valori numerici sono obbligatori';
}