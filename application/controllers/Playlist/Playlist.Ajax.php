<?php

	class Playlist_Controller extends Controller{
            
		function add($idmorceau=0){
			$this->load_model('Music',"objmusic");
			$idpl=1;
			$this->objmusic->add_track($idpl,$idmorceau);
			echo $idmorceau;
		}

	}
	
?>
