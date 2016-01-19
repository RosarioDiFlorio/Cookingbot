

<?php


class Liquids {
	
	private $approx;
	private $teaspoon;
	private $tablespoon;
	private $cup ;
	private $pint;
	private $PintTeaspoon;
	private $CupTeaspoon;
	private $TablespoonTeaspoon;
	private $PintTablespoon;
	private $CupTablespoon;
	private $PintCup;
	private $l;
	private $cl;
	private $ml;
	
	
	function __construct(){
		$this->approx = 3;
		$this->teaspoon = "5 ml";
		$this->tablespoon = " 15 ml";
		$this->cup = " 250 ml";
		$this->pint = " 500 ml";
		$this->l = " 1000 ml";
		$this->cl = " 10 ml";
		$this->ml = " 1 ml";
		$this->PintTeaspoon = round($this->pint/$this->teaspoon,$this->approx);
		$this->CupTeaspoon =  round($this->cup/$this->teaspoon,$this->approx);		
		$this->TablespoonTeaspoon = round($this->tablespoon/$this->teaspoon,$this->approx);
		$this->CupTablespoon = round($this->cup/$this->tablespoon,$this->approx);
		$this->PintTablespoon = round($this->pint/$this->tablespoon,$this->approx);
		$this->PintCup = round($this->pint/$this->cup,$this->approx);
		$this->lCl = $this->l/$this->cl;
		$this->lMl = $this->l/$this->ml;
		$this->clMl = $this->cl/$this->ml;
	
		
	}
	
	
	
	
	
//ML CONVERSION --------------------------------------------------------------------------------------
	
	public function ml_to_teaspoon($quantita = 1){
		return round($quantita/$this->teaspoon,$this->approx);
	}
	public function ml_to_tablespoon($quantita = 1){
		return round($quantita/$this->tablespoon,$this->approx);
		
	}
	public function ml_to_cup($quantita = 1){
		return round($quantita/$this->cup,$this->approx);
		
	}public function ml_to_pint($quantita = 1){
		return round($quantita/$this->pint,$this->approx);
		
	}
	public function ml_to_cl($quantita = 1){
		return $quantita/$this->clMl;
	}
	public function ml_to_l($quantita = 1){
		return $quantita/$this->lMl;
	}

//CL CONVERSION ---------------------------------------------------------------------------------------
	
	public function cl_to_ml($quantita = 1){
		return $quantita * $this->clMl;
	}
	public function cl_to_l($quantita = 1){
		return $quantita / $this->lCl;
	}
	public function cl_to_teaspoon($quantita = 1){
		return round($this->ml_to_teaspoon($this->cl_to_ml($quantita)),$this->approx);
	}
	public function cl_to_tablespoon($quantita = 1){
		return round($this->ml_to_tablespoon($this->cl_to_ml($quantita)),$this->approx);
	}
	public function cl_to_cup($quantita = 1){
		return round($this->ml_to_cup($this->cl_to_ml($quantita)),$this->approx);
	}
	public function cl_to_pint($quantita = 1){
		return round($this->ml_to_pint($this->cl_to_ml($quantita)),$this->approx);
	}
	
	
	
//L CONVERSION ----------------------------------------------------------------------------------------

	public function l_to_ml($quantita = 1){
		return $quantita * $this->lMl;
	}
	public function l_to_cl($quantita = 1){
		return $quantita * $this->lCl;
	}
		public function l_to_teaspoon($quantita = 1){
		return round($this->ml_to_teaspoon($this->l_to_ml($quantita)),$this->approx);
	}
	public function l_to_tablespoon($quantita = 1){
		return round($this->ml_to_tablespoon($this->l_to_ml($quantita)),$this->approx);
	}
	public function l_to_cup($quantita = 1){
		return round($this->ml_to_cup($this->l_to_ml($quantita)),$this->approx);
	}
	public function l_to_pint($quantita = 1){
		return round($this->ml_to_pint($this->l_to_ml($quantita)),$this->approx);
	}
	
	
//TEASPOOON CONVERSION -------------------------------------------------------------------------------
	
	
	public function teaspoon_to_pint($quantita = 1){
		return round($this->ml_to_pint($this->teaspoon_to_ml($quantita)),$this->approx);
		
	}
	public function teaspoon_to_cup($quantita = 1){
		return round($quantita/$this->CupTeaspoon,$this->approx);
	}
	
	public function teaspoon_to_tablespoon($quantita = 1){
		return round($quantita /$this->TablespoonTeaspoon, $this->approx);
	}
	
	public function teaspoon_to_ml($quantita = 1){
		return round($quantita * $this->teaspoon,$this->approx);
		
	}
	public function teaspoon_to_cl($quantita = 1){
		return round($this->ml_to_cl($this->teaspoon_to_ml($quantita)),$this->approx);
	}
	public function teaspoon_to_l($quantita = 1){
		return round($this->ml_to_l($this->teaspoon_to_ml($quantita)),$this->approx);
	}
	
//TABLESPOON CONVERSION -----------------------------------------------------------------------------------
	public function tablespoon_to_teaspoon($quantita = 1){
		return round($quantita * $this->TablespoonTeaspoon,$this->approx);
	}
	public function tablespoon_to_cup ($quantita = 1){
		return round ($quantita / $this->CupTablespoon,$this->approx);
	}
	public function tablespoon_to_pint($quantita = 1){
		return round($quantita / $this->PintTablespoon,$this->approx);
	}
	public function tablespoon_to_ml($quantita = 1){
		return round($quantita * $this->tablespoon, $this->approx);
	}
	public function tablespoon_to_cl($quantita = 1){
		return round($this->ml_to_cl($this->tablespoon_to_ml($quantita)),$this->approx);		
	}
	public function tablespoon_to_l($quantita = 1){
		return round($this->ml_to_l($this->tablespoon_to_ml($quantita)),$this->approx);
	}
//CUP CONVERSION ----------------------------------------------------------------------------------------------	
	
	
	public function cup_to_teaspoon($quantita = 1){
		return round($quantita * $this->CupTeaspoon,$this->approx);
	}
	
	public function cup_to_tablespoon($quantita = 1){
		return round( $quantita * $this->CupTablespoon,$this->approx ); 
	}
	public function cup_to_pint($quantita = 1 ){
		return round($quantita / $this->PintCup,$this->approx);
	}
	
	public function cup_to_ml($quantita = 1){
		
		return round($quantita * $this->cup, $this->approx);
		
	}
	public function cup_to_cl($quantita = 1){
		return round($this->ml_to_cl($this->cup_to_ml($quantita)),$this->approx);
		
	}
	public function cup_to_l($quantita = 1){
		return round($this->ml_to_l($this->cup_to_ml($quantita)),$this->approx);
		
	}
	
	
//PINT CONVERSION --------------------------------------------------------------------------------------------	
	
	
	public function pint_to_teaspoon ($quantita = 1){
		return round ($quantita * $this->PintTeaspoon,$this->approx);
	}
	public function pint_to_tablespoon($quantita = 1){
		return round ($quantita  * $this->PintTablespoon,$this->approx);
	}
	public function pint_to_cup($quantita = 1){
		return round ( $quantita * $this->PintCup,$this->approx    );
	}
	public function pint_to_ml($quantita = 1){
		return round($quantita *$this->pint,$this->approx);
		
	}
	public function pint_to_cl($quantita = 1){
		return round($this->ml_to_cl($this->pint_to_ml($quantita)),$this->approx);
		
	}
	public function pint_to_l($quantita = 1){
		return round($this->ml_to_l($this->pint_to_ml($quantita)),$this->approx);
	}
	
	

	
}









?>