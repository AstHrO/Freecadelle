<?php

	class Administration_Controller extends Controller{
		
	
            
		function index(){
			$pl_statut=array(0=>"Nouvelle",10=>"En cours",20=>"Terminée",30=>"Gravée");

			$this->load_model("Music","objm");
			$clients=$this->objm->get_clients();
			$oldclient=-1;

			if ($clients)
			foreach ($clients as $client){

				if ($client['CODE_CLIENT']!=$oldclient){

					if ($oldclient!=-1){
						$this->form_obj->add_button();
						$this->form_obj->close_table();
						$this->form_obj->draw( $ajax = true );
					}
					$oldclient=$client['CODE_CLIENT'];
					$this->load_library("Form","form_obj");
					if ($client['CODE_LISTE']==0) {
						$statut="Libre";
					} else {
						$statut=$pl_statut[$client['STATUT']];
					}
					$this->form_obj->init_form("ajax.php/Administration");
					$this->form_obj->open_table("Poste ".$client['CODE_CLIENT'],$statut);
					$this->form_obj->add_html("<span class='title'>".$client['ARTISTE_NOM']." ".$client['MORCEAU_NOM']."</span>");


				} else {
					$this->form_obj->add_html("<span class='title'>".$client['ARTISTE_NOM']." ".$client['MORCEAU_NOM']."</span>");
				}
			}
			$this->form_obj->add_button();
			$this->form_obj->close_table();
			$this->form_obj->draw( $ajax = true );
			add_javascript('function test() 
{ 
var nbreMillisec = 500; 
setTimeout("test();", nbreMillisec); 
} 
test(); ');

		}
	
	}
