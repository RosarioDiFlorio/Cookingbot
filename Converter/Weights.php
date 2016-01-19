<?php



class Weights{
	private $approx;
	private $ounce;
	private $pound;
	private $poundOunce;
	private $kg;
	
	
	function __construct (){
		$this->approx = 3;
		$this->ounce = " 28 g";
		$this->pound = " 450 g";
		$this->kg= " 1000 g";
		$this->poudOnce =round($this->pound/$this->ounce,$this->approx);
		
		
		
	}
	
	
	
	//GR CONVERSION ---------------------------------------------------
	
	public function g_to_ounce($quantita = 1){
		return round ($quantita / $this->ounce,$this->approx);
	}
	public function g_to_pound($quantita = 1){
		return round($quantita / $this->pound,$this->approx);
	}
	public function g_to_kg($quantita = 1){
		return round($quantita / $this->kg,$this->approx);
	}
	//KG CONVERSION ------------------------------------------------------
	public function kg_to_g($quantita = 1){
		return round($quantita * $this->kg,$this->approx);
	}
	public function kg_to_ounce($quantita = 1){
		return round($this->g_to_ounce($this->kg_to_g($quantita)),$this->approx);
	}
	public function kg_to_pound($quantita = 1){
		return round($this->g_to_pound($this->kg_to_g($quantita)),$this->approx);
	}
	
	//OUNCE CONVERSION --------------------------------------------------
	public function ounce_to_pound($quantita = 1){
		return round($quantita / $this->poudOnce,$this->approx);
	}
	public function ounce_to_g($quantita = 1 ){
		return round ($quantita  * $this->ounce,$this->approx);
		
	}
	public function ounce_to_kg($quantita = 1){
		return round($this->g_to_kg($this->ounce_to_g($quantita)),$this->approx);
	}
	//POUND CONVERSION ---------------------------------------------------
	public function pound_to_ounce($quantita = 1){
		return round ($quantita * $this->poudOnce,$this->approx);
	}
	public function pound_to_g($quantita = 1){
		return round ($quantita * $this->pound,$this->approx);
	}
	public function pound_to_kg($quantita = 1){
		return round ($this->g_to_kg($this->pound_to_g($quantita)),$this->approx);
	}
	
	
	
}









?>