<?php 
include_once dirname(__FILE__).'/../API/http_API.php';
include_once dirname(__FILE__).'/../API/query_sparql.php';

$base = getPrefix();
	
	$query = $base . "SELECT ?label WHERE { ?food rdf:type comp:Food; rdfs:label ?label}";
	
	$res = sparqlQuery($query,"json");
	//print_r($res);
	$data = json_decode($res);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$ar = [];
	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//print_r($toCicle[$i]->label->value);
		$ar[$i] = $toCicle[$i]->label->value;
	}
//$ar = array('apple', 'orange', 'banana', 'strawberry');
$ar = array_unique($ar);
json_encode($ar);
?>
<!doctype html>
<html lang="en">
<head>
    <title></title>
    <script src="jquery.min.js"></script>
    <script type="text/javascript" src="jquery.typeahead.js"></script>
    <link href="examples.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
		$(document).ready(function () {
			$('input.ingredients').typeahead({
                name: 'ingredients',
                local: <?php echo json_encode($ar) ?>
            });
		});
    </script>
</head>
<body>
    <div align="center">
        <div style="height:800px">
            <div style="width: 1000px; height: 300px;">
                <div style="float: left; width: 500px">
                    <h4>Ingredient?</h4>
                    <input class="ingredients typeahead" type="text" placeholder="Ingredient">
                </div>
            </div>
        </div>
    </div>
</body>
</html>