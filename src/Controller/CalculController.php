<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use App\Service\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CalculController extends AbstractController
{
    /**
     * @Route("/calcul/index")
     */
    public function index(Request $request, Calculator $calculator): Response
    {

        if($request && $request->getContent()){

            $number1 =  $request->get('number1');
            $number2 =  $request->get('number2');
            $operation =  $request->get('operation');


            print_r("\nnumber1 : " . $number1);
            print_r("\nnumber2 : " . $number2);
            print_r("\noperation : " . $operation);


            if ($operation === 'plus') {

                $total = $calculator->add($_POST['number1'], $_POST['number2']);

                print_r("\nìtotal : " . $total);
            }
            die;
        }

        return $this->render('calcul/index.html.twig', [

        ]);
    }
}
/*
//Se il pulsante di invio è stato premuto
if (is_numeric($_POST['number1']) && is_numeric($_POST['number2'])) {
$calculator = new \AppendIterator;

//Controlla i valori numerici
if ($_POST['operation'] == 'plus') {

$total = $calculato->add($_POST['number1'], $_POST['number2']);
}
else if ($_POST['opration'] == 'minus') {

$total = $calculator->subtract($_POST['number1'], $_POST['number2']);

} else if ($_POST['operation'] == 'times') {

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
*/