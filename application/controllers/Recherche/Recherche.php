<?php

	class Recherche_Controller extends Controller{
		
	
            
		function index(){
			$this->load_model("music","mobj");		
			$cloud = $this->mobj->get_genre_cloud();
			echo "<div id='cloud'>".$cloud."</div>";
		


		}
			
		function par_genre($genre=''){
			$this->load_model("music","mobj");
			$this->load_library("form","frm");
			$liste= $this->mobj->get_morceaux($genre);	
			$tpl=new View;
			$_SESSION["tGenre"]=$genre;	
			$tpl->assign("resultat",$liste);
//		        $tpl->add_script("jquery.dataTables.min");
			$tpl->draw("Recherche/Resultat");
			
		}


		function par_album($codealbum=0){
			$this->load_model("music","mobj");
			$liste= $this->mobj->get_album($codealbum);	
			$tpl=new View;
			$tpl->assign("resultat",$liste);
			$tpl->draw("Recherche/Resultat");
			
		}

	}
	
?>
