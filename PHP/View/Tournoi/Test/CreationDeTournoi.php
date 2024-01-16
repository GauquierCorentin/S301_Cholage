<!DOCTYPE html>

<head>

 <title>jQuery Bracket</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
 <script type="text/javascript" src="js/jquery.bracket.min.js"></script>
 <script type="text/javascript" src="js/tournoi.js"></script>
 <link rel="stylesheet" type="text/css" href="css/jquery.bracket.min.css" />
 </head>

 <body>
 <?php
 function genererMatch($listecompetiteurs) {
     $couleur=true;
     $lstmatch=[];
     $copie=$listecompetiteurs;
     for ($i=0;$i<sizeof($listecompetiteurs)-2;$i++) {
         $listeblanc = [];
         $listenoire = [];
         if ($couleur == true) {
             array_push($listeblanc, $copie[0]);
             array_push($listenoire, $copie[sizeof($copie) - 1]);
             $couleur = false;
         } else {
             array_push($listenoire, $copie[0]);
             array_push($listeblanc, $copie[sizeof($copie) - 1]);
             $couleur = true;
         }
         for ($j = 1; $j < sizeof($copie) - 1; $j++) {
             if (($j + 1) % 2 == 0) {
                 array_push($listenoire, $copie[$j]);
             } else {
                 array_push($listeblanc, $copie[sizeof($copie) - $j]);
             }
         }

         for ($j = 0; $j < sizeof($listeblanc); $j++) {
             array_push($lstmatch, [$listeblanc[$j], $listenoire[$j]]);
         }
         $copie2 = $copie;
         $mem = $copie[sizeof($copie) - 1];
         for ($j = 0; $j < sizeof($listecompetiteurs); $j++) {
             if ($j != 0) {
                 $copie[$j] = $copie2[$j - 1];
             }
         }
         $copie[1] = $mem;


         echo "<br></br>listeblanc<br>";
         foreach ($listeblanc as $item) {
             echo $item . "  ";
         }
         echo "<br>listenoire<br>";
         foreach ($listenoire as $item) {
             echo $item . "  ";
         }
         echo "<br>liste ronde<br>";
         foreach ($copie as $item) {
             echo $item . "  ";
         }
     }
 }

 genererMatch(range(1,14));

 ?>


 </body>
