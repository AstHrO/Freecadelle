<?php

	class Compilation_Controller extends Controller{
            
		function index(){

			$this->load_model("music","mobj");
			$liste = $this->mobj->get_list();	
			if (!$liste){
				echo "aucune liste !";
			} else {
				$output = shell_exec("/srv/http/fricadelle/burner.sh 1");
				echo "<pre>$output</pre>";
			foreach ($liste as $titre){
				echo "<li>".$titre['MORCEAU_NOM'];

			}

			}
			
			
		}

	}
	
?>
