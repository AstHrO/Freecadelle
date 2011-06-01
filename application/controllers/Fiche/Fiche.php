<?php

	class Fiche_Controller extends Controller{
		
	
            
		function artiste($idartiste){
			$tpl = new View;
			$this->load_model("Music","objm");
			$rMorceaux=$this->objm->get_morceaux_artiste($idartiste);
			$rFiche=$this->objm->get_artiste($idartiste);
			$tpl->assign("fiche",$rFiche[0]);
			$tpl->assign("resultat",$rMorceaux);
			$tpl->draw("Fiche/artiste");
	


		}
			


		function album($idalbum){

		}

	}
	
?>
