<?php
require_once('gid/getid3.php');
	class Playlist_Controller extends Controller{
            
		function add($idmorceau=0){
			$this->load_model('Music',"objmusic");
			if (!$_SESSION["idListe"]) $_SESSION["idListe"]=0;

			$this->objmusic->add_track($idmorceau);
			header("location:".URL."index.php/Recherche/par_genre/".$_SESSION['tGenre']."/");

		}
		function del($idmorceau=0){
			$this->load_model('Music',"objmusic");
			if (!$_SESSION["idListe"]) $_SESSION["idListe"]=0;

			$this->objmusic->del_track($idmorceau);
			//header("location:".URL."index.php/Recherche/par_genre/".$_SESSION['tGenre']."/");

		}

		function vider($idpl=0){
			$this->load_model('Music',"objmusic");
			if (!$_SESSION["idListe"]) $_SESSION["idListe"]=0;

			$this->objmusic->empty_list();
			header("location:".URL."index.php/Recherche/");

		}

		function nouvelle(){
			$this->load_model('Music',"objmusic");
			if (!$_SESSION["idListe"]) $_SESSION["idListe"]=0;
   		 	$_SESSION["idListe"] = $this->objmusic->new_session();
			header("location:".URL."index.php/Recherche/");
	
		}

		function envoyer(){

		}

		function test(){
		$this->load_model('Music',"objmusic");
		$dir = 'import/';
		$dhandle = opendir($dir);
		$old_files = array();

		if ($dhandle) {
		while (false !== ($fname = readdir($dhandle))) 
		{
		if ( ($fname != '.') && ($fname != '..') && !is_dir($dir."/".$fname )) 
		{
		$old_files[] = $fname;
		}

		}
		closedir($dhandle);
		}

		$new_files = str_replace(' ','_',$old_files);
		$x=0;
		foreach($old_files as $file)
{ 
				rename($dir.'/'.$file,$dir.'/'.$new_files[$x++]);
}


		if ($handle = opendir('import/')) {
		    while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				$ret=$this->objmusic->mp3_import($dir."/".$file);
			}
		    }
		    closedir($handle);
		}
		
	}
	}
	
?>
