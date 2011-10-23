<?php

class Entete 
{
	#	internal variables
		public $laligne ="";
		public $numargs = "";
		public $whatwhat;
		var $value;
		var $laval;
		var $lelien;
		
	#	Constructor
	public function __construct ()
	{
		$this->numargs = func_num_args();
		$arg_list = func_get_args();
		$case_liste = array();
		  for ($i = 0; $i < ($this->numargs-1); $i++) {
			$laval = $this->CkeckRempl($arg_list[$i]);
			$lelien = $this->Ckecklelien($arg_list[$i]);
			$case_liste[$i] = new UneCase($laval, "th", "listingprod", $lelien);
			$this->whatwhat .= $case_liste[$i]->lacase;
		  }
		return $this->whatwhat;
	}
	###	
	public function CkeckRempl($value)
	{
		switch($value){
			case "@modif";
			return "<img border='0' src='../img/pencil.gif' alt='modif'>";
			break;
			case "CMD_button";
			return "<input type=\"submit\" value=\"CMD\">";
			break;
			default;
			return $value;
			break;
		}
	}
	
	
	public function Ckecklelien($value)
	{
		switch($value){
			case "&#8364;";
			return "produit?action=classer&ordre=totalprix";
			break;
			case "produit";
			return "produit?action=classer&ordre=".$value;
			break;
			default;
			return "produit?action=classer&ordre=id_".$value;
			break;
		}
	}
	
}


class UneCase extends Entete {
  public $intitule, $type, $css, $lien;
	public $lacase ="";

//Ex : $Titre = new UneCase("Titre", "th", "listingprod", "produit?action=classer&ordre=id_titre");

   function __construct($iIntitule,$iType,$iCss,$iLien) {
	$this->intitule = $iIntitule;
    $this->type = $iType;
    $this->css = $iCss;
	$this->lien = $iLien;
    $this->makecase();
  }


	public function makecase() {
	$this->lacase =  "<".$this->type;
	if($this->css!=""){ $this->lacase .= " class=\"".$this->css. "\"";}
	
	$this->lacase .= " >";
	if($this->lien!=""){ $this->lacase .= "<a class=\"".$this->css."\" href='".$this->lien."'>" ;}
		$this->lacase .= $this->intitule;
	if($this->lien!=""){ $this->lacase .= "</a>"; }	
		$this->lacase .="</".$this->type.">";
	}

}

?>
