<?php

require dirname(__FILE__) . "/votazioni_api.php";



$nomeRicetta="ricetta2";
$nomeSub="sub1";
$voto = 30;
$idUtente = 1;


$votazioni = new VotazioniAPI();
$votazioni->addRecipe($nomeRicetta);
print_r( $votazioni->getAllRecipe());
echo "<br>";
print_r($ricetta = $votazioni->getRecipe($nomeRicetta));
echo "<br>";
$votazioni->addRecipeVote($idUtente, $ricetta['id_ricetta'],$voto);

echo $votazioni->getRecipeVote($ricetta['id_ricetta']);
echo "<br>";
echo "<br>";


$votazioni->addSubstitution($nomeSub);
print_r($votazioni->getAllSubstitution());
echo "<br>";
print_r($sostituzione = $votazioni->getSubstitution($nomeSub));
echo "<br>";
$votazioni->addSubstitutionVote($idUtente,$sostituzione['id_sub'],$voto);

echo $votazioni->getSubstitutionVote($sostituzione['id_sub']);
echo "<br>";
echo "<br>";

?>