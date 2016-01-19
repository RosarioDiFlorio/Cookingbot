<?php

include_once dirname(__FILE__).'/Weights.php';
include_once dirname(__FILE__).'/Liquids.php';


class Converter {
	
	private $weights;
	private $liquids;
	private $resultWeights;
	private $resultLiquids;
	
	function __construct(){
			$this->weights = new Weights();
			$this->liquids = new Liquids();
			$this->resultWeights = array(
			"g"=>"",
			"kg"=>"",
			"pound"=>"",
			"ounce"=>""
			);
			$this->resultLiquids= array(
			"ml"=>"",
			"cl"=>"",
			"l"=>"",
			"teaspoon"=>"",
			"tablespoon"=>"",
			"cup"=>"",
			"pint"=>""
			);
		
		
	}
	
	
	function getAllMeasures($tipo,$quantita){
		
		if($tipo == "g"||$tipo == "kg"||$tipo == "ounce"||$tipo == "pound"){
			if($tipo == "g"){
				$this->resultWeights['g']=$quantita;
				$this->resultWeights['kg']=$this->weights->g_to_kg($quantita);
				$this->resultWeights['ounce']=$this->weights->g_to_ounce($quantita);
				$this->resultWeights['pound']=$this->weights->g_to_pound($quantita);
			}else if($tipo == "kg"){
				$this->resultWeights['g']=$this->weights->kg_to_g($quantita);
				$this->resultWeights['kg']=$quantita;
				$this->resultWeights['ounce']=$this->weights->kg_to_ounce($quantita);
				$this->resultWeights['pound']=$this->weights->kg_to_pound($quantita);
			}else if($tipo == "ounce"){
				$this->resultWeights['g']=$this->weights->ounce_to_g($quantita);
				$this->resultWeights['kg']=$this->weights->ounce_to_kg($quantita);
				$this->resultWeights['ounce']=$quantita;
				$this->resultWeights['pound']=$this->weights->ounce_to_pound($quantita);
			}else if($tipo == "pound"){
				$this->resultWeights['g']=$this->weights->pound_to_g($quantita);
				$this->resultWeights['kg']=$this->weights->pound_to_kg($quantita);
				$this->resultWeights['ounce']=$this->weights->pound_to_ounce($quantita);
				$this->resultWeights['pound']=$quantita;
			}
			
			return $this->resultWeights;
		}else{
			
			if($tipo =="ml"){
			
				$this->resultLiquids['ml'] = $quantita;
				$this->resultLiquids['cl'] = $this->liquids->ml_to_cl($quantita);
				$this->resultLiquids['l'] = $this->liquids->ml_to_l($quantita);
				$this->resultLiquids['teaspoon']=$this->liquids->ml_to_teaspoon($quantita);
				$this->resultLiquids['tablespoon'] = $this->liquids->ml_to_tablespoon($quantita);
				$this->resultLiquids['cup'] =$this->liquids->ml_to_cup($quantita);
				$this->resultLiquids['pint'] =$this->liquids->ml_to_pint($quantita);
			
			}else if($tipo == "cl"){
				
				$this->resultLiquids['ml'] = $this->liquids->cl_to_ml($quantita);
				$this->resultLiquids['cl'] = $quantita;
				$this->resultLiquids['l'] = $this->liquids->cl_to_l($quantita);
				$this->resultLiquids['teaspoon']=$this->liquids->cl_to_teaspoon($quantita);
				$this->resultLiquids['tablespoon'] = $this->liquids->cl_to_tablespoon($quantita);
				$this->resultLiquids['cup'] =$this->liquids->cl_to_cup($quantita);
				$this->resultLiquids['pint'] =$this->liquids->cl_to_pint($quantita);
				
			}else if($tipo == "l"){
				
				$this->resultLiquids['ml'] = $this->liquids->l_to_ml($quantita);
				$this->resultLiquids['cl'] = $this->liquids->l_to_cl($quantita);
				$this->resultLiquids['l'] = $quantita;
				$this->resultLiquids['teaspoon']=$this->liquids->l_to_teaspoon($quantita);
				$this->resultLiquids['tablespoon'] = $this->liquids->l_to_tablespoon($quantita);
				$this->resultLiquids['cup'] =$this->liquids->l_to_cup($quantita);
				$this->resultLiquids['pint'] =$this->liquids->l_to_pint($quantita);
				
			}else if($tipo == "teaspoon"){
				
				$this->resultLiquids['ml'] = $this->liquids->teaspoon_to_ml($quantita);
				$this->resultLiquids['cl'] = $this->liquids->teaspoon_to_cl($quantita);
				$this->resultLiquids['l'] = $this->liquids->teaspoon_to_l($quantita);
				$this->resultLiquids['teaspoon']=$quantita;
				$this->resultLiquids['tablespoon'] = $this->liquids->teaspoon_to_tablespoon($quantita);
				$this->resultLiquids['cup'] =$this->liquids->teaspoon_to_cup($quantita);
				$this->resultLiquids['pint'] =$this->liquids->teaspoon_to_pint($quantita);
				
			}else if($tipo == "tablespoon"){
				
				$this->resultLiquids['ml'] = $this->liquids->tablespoon_to_ml($quantita);
				$this->resultLiquids['cl'] = $this->liquids->tablespoon_to_cl($quantita);
				$this->resultLiquids['l'] = $this->liquids->tablespoon_to_l($quantita);
				$this->resultLiquids['teaspoon']=$this->liquids->tablespoon_to_teaspoon($quantita);
				$this->resultLiquids['tablespoon'] = $quantita;
				$this->resultLiquids['cup'] =$this->liquids->tablespoon_to_cup($quantita);
				$this->resultLiquids['pint'] =$this->liquids->tablespoon_to_pint($quantita);
				
			}else if($tipo == "cup"){
				
				$this->resultLiquids['ml'] = $this->liquids->cup_to_ml($quantita);
				$this->resultLiquids['cl'] = $this->liquids->cup_to_cl($quantita);
				$this->resultLiquids['l'] = $this->liquids->cup_to_l($quantita);
				$this->resultLiquids['teaspoon']=$this->liquids->cup_to_teaspoon($quantita);
				$this->resultLiquids['tablespoon'] = $this->liquids->cup_to_tablespoon($quantita);
				$this->resultLiquids['cup'] =$quantita;
				$this->resultLiquids['pint'] =$this->liquids->cup_to_pint($quantita);
				
			}else if($tipo == "pint"){
				
				$this->resultLiquids['ml'] = $this->liquids->pint_to_ml($quantita);
				$this->resultLiquids['cl'] = $this->liquids->pint_to_cl($quantita);
				$this->resultLiquids['l'] = $this->liquids->pint_to_l($quantita);
				$this->resultLiquids['teaspoon']=$this->liquids->pint_to_teaspoon($quantita);
				$this->resultLiquids['tablespoon'] = $this->liquids->pint_to_tablespoon($quantita);
				$this->resultLiquids['cup'] =$this->liquids->pint_to_cup($quantita);
				$this->resultLiquids['pint'] =$quantita;
				
			}
			
			return $this->resultLiquids;
			
			
			
			
			
			
			
		}
		
		
		
	}	
}


?>