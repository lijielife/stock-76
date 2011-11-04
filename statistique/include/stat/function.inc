<?php

class Entete 
{
	#	internal variables
		public $css ="";
		public $action ="";
		public $ordre ="";
		public $sens = "";
		public $whatwhat;
		protected $numcase;
		
	#	Constructor
	function __construct($iCss, $iLaction, $iOrdre, $iSens, $iOnly){ 
    	$this->css = $iCss;
		$this->action = $iLaction;
		$this->ordre = $iOrdre;
		$this->only = $iOnly;
		if($iSens=="up"){ $this->sens .= "down"; }
		if($iSens=="down"){ $this->sens .= "up"; }
	
	}
	###	
	public function make_ligne($thete){
		$this->numcase = count($thete);
		for ($i = 1; $i <= $this->numcase; $i++) {
			$intitule = $thete[$i][0];
			$classement = $thete[$i][1];
			$this->whatwhat .="<th class=\"".$this->css."\">";
			
			if($classement!=""){
				$this->whatwhat .="<a class=\"".$this->css."";
				if($this->ordre==$classement){$this->whatwhat.= " ".$this->sens."";}
				$this->whatwhat .= "\" href=\"index?";
				if($this->action!=""){$this->whatwhat.= "action=".$this->action."&";}
				$this->whatwhat.="ordre=".$classement;
				if($this->ordre==$classement && $this->sens!=""){$this->whatwhat.= "&sens=".$this->sens;}
				if($this->only!=""){$this->whatwhat.= "".$this->only."";}
				$this->whatwhat.= "\" >";
				}
			$this->whatwhat .="".$intitule."";
			if($classement!=""){
				$this->whatwhat .="</a>";
				}
				$this->whatwhat .="</th>\n";
		 }

		return $this->whatwhat;
	}
}

?>