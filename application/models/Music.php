<?php

class Music_Model extends Model{
	
	function get_genre( $parent_id =null){
		$db = DB::get_instance();
		$sql= "SELECT genre.ID,LIBELLE_GENRE,count(morceau.ID) as VOLUME FROM genre left join morceau on morceau.CODE_GENRE=genre.ID GROUP BY genre.ID";
		$ret= $db->get_list($sql,null,"LIBELLE_GENRE","VOLUME");
		return $ret;
	}

	function get_clients(){
		$db = DB::get_instance();
		$sql= "SELECT * from client c";
		$sql.= " left join playlist p on p.ID = c.code_liste ";	
		$sql.= " left join playlist_content pc on pc.CODE_PLAYLIST = p.ID ";	
		$sql.= " left join morceau m on m.ID = pc.code_morceau ";
		$sql.= " left join artiste a on a.id = m.code_artiste ORDER BY c.code_client";
		$ret= $db->get_list($sql);
//dump('$ret);
		return $ret;
	}

	function get_genre_cloud(){
		$tags = $this->get_genre();
		$min_font_size = 12;
		$max_font_size = 30;
		$minimum_count = min(array_values($tags));
		$maximum_count = max(array_values($tags));
		$spread = $maximum_count - $minimum_count;
		if($spread == 0) {
		    $spread = 1;
		}
		$cloud_html = '';
		$cloud_tags = array(); // create an array to hold tag code
		foreach ($tags as $tag => $count) {
			$size = $min_font_size + ($count - $minimum_count) * ($max_font_size - $min_font_size) / $spread;
			$cloud_tags[] = '<a style="font-size: '. floor($size) . 'px' 
			. '" class="tag_cloud" href="'.URL.'index.php/Recherche/par_genre/' . $tag 
			. '/" title="\'' . $tag  . '\' : ' . $count . ' morceaux">' 
			. htmlspecialchars(stripslashes($tag)) . '</a>';
		}
		$cloud_html = join("\n", $cloud_tags) . "\n";
		return $cloud_html;
	}


	function get_morceaux($genre){
		$db = DB::get_instance();
		$sql = " SELECT  morceau.ID mID, artiste.ID aID,genre.ID gID,genre.*,morceau.*,artiste.*,album.* FROM morceau ";
		$sql.= " left join genre on genre.id = morceau.code_genre ";
		$sql.= " left join artiste on artiste.id = morceau.code_artiste ";
		$sql.= " left join album on album.id = morceau.code_album  ";
		$sql.= " where genre.libelle_genre='".$genre."' " ;

		$ret= $db->get_list($sql);
		if ($ret)
		foreach($ret as $key=>$track){
			$seconds=$ret[$key]['DUREE']/1000;
			$mins = floor ($seconds / 60);
		        $secs = $seconds % 60;
			$ret[$key]['DUREE']=  sprintf ("%d:%2.0f",$mins, $secs);

		}


		return $ret;

		
	}
	function get_morceaux_artiste($idArtiste){
		$db = DB::get_instance();
		$sql = " SELECT morceau.ID mID, artiste.ID aID,genre.ID gID,genre.*,morceau.*,artiste.*,album.* FROM morceau ";
		$sql.= " left join genre on genre.id = morceau.code_genre ";
		$sql.= " left join artiste on artiste.id = morceau.code_artiste ";
		$sql.= " left join album on album.id = morceau.code_album  ";
		$sql.= " where artiste.ID='".$idArtiste."' " ;
		$ret= $db->get_list($sql);
		foreach($ret as $key=>$track){
			$seconds=$ret[$key]['DUREE']/1000;
			$mins = floor ($seconds / 60);
		        $secs = $seconds % 60;
			$ret[$key]['DUREE']=  sprintf ("%d:%2.0f",$mins, $secs);

		}


		return $ret;

		
	}

		function get_album($idAlbum){
		$db = DB::get_instance();
		$sql = " SELECT morceau.ID mID, artiste.ID aID,genre.ID gID,genre.*,morceau.*,artiste.*,album.* FROM morceau ";
		$sql.= " left join genre on genre.id = morceau.code_genre ";
		$sql.= " left join artiste on artiste.id = morceau.code_artiste ";
		$sql.= " left join album on album.id = morceau.code_album  ";
		$sql.= " where album.ID='".$idAlbum."' " ;
		$ret= $db->get_list($sql);
		if ($ret)
		foreach($ret as $key=>$track){
			$seconds=$ret[$key]['DUREE']/1000;
			$mins = floor ($seconds / 60);
		        $secs = $seconds % 60;
			$ret[$key]['DUREE']=  sprintf ("%d:%2.0f",$mins, $secs);

		}


		return $ret;
		
	}
	function get_artiste($id=0){
		$db = DB::get_instance();
		$sql= "SELECT * FROM artiste WHERE ID=".$id;
		$ret= $db->get_list($sql);
		return $ret;
		
	}
	function check_playlist(){
		if ($_SESSION["idListe"]==0){
			$_SESSION["idListe"]==$this->new_session();			
		}
	}

	function add_track($idtrack){
		$this->check_playlist();
		$db = DB::get_instance();
		$ret=$db->get_list("SELECT * from playlist_content where CODE_MORCEAU=? AND CODE_PLAYLIST=?",array($idtrack,$_SESSION["idListe"]));
		// Vérifier que le morceau n'y est pas déjà :
		if(!$ret){
			$db->insert("playlist_content",array("CODE_MORCEAU"=>$idtrack,"CODE_PLAYLIST"=>$_SESSION["idListe"]));
			$db->update("playlist",array("DATE_MAJ"=>date("Y-m-d H:i:s"),"STATUT"=>10),"ID=".$_SESSION["idListe"]);
		}
	}

	function del_track($idtrack){
		$db = DB::get_instance();
		$db->delete("playlist_content","CODE_MORCEAU=$idtrack AND CODE_PLAYLIST=".$_SESSION["idListe"]);
	}


	function empty_list(){
		$db = DB::get_instance();
		$db->delete("playlist_content","CODE_PLAYLIST=".$_SESSION["idListe"]);
	}

	function get_list(){
		$db = DB::get_instance();
		$idliste=(isset($_SESSION['idListe']))?$_SESSION['idListe']:0;
		$sql="SELECT pc.ID mID,pc.*,m.*,a.*  from playlist_content pc ";
		$sql.="left join morceau m on m.ID=CODE_MORCEAU ";
		$sql.="left join artiste a on a.ID=CODE_ARTISTE ";
		$sql.="where pc.CODE_PLAYLIST=".$idliste; 
		$ret=$db->get_list($sql);
		if ($ret)
		foreach($ret as $key=>$track){
			$seconds=$ret[$key]['DUREE']/1000;
			$mins = floor ($seconds / 60);
		        $secs = $seconds % 60;
			$ret[$key]['DUREE']=  sprintf ("%d:%2.0f",$mins, $secs);

		}
		return $ret;	
	}

	function new_session(){
		
		$db=DB::get_instance();
		$db->insert("playlist",array("USER_NOM"=>NUM_POSTE,"STATUT"=>0));
		$_SESSION['idListe']=$db->get_insert_id();
		$db->update("client",array("CODE_LISTE"=>$_SESSION["idListe"]),"CODE_CLIENT=".NUM_POSTE);
		
		return $_SESSION['idListe'];
	}

	function mp3_import($fichier){
			//$tag = $this->get_tags($fichier);
//			$tag = new mp3Reader($fichier);
			$tag=tagReader($fichier);
			//list($title, $artist, $album, $year, $comment, $genre, $track) = explode ("-", $tag);

			$db=DB::get_instance();

			$ca=$db->get_list("SELECT * from genre where LIBELLE_GENRE='".$tag['Genre']."'");
			$id_genre=$ca[0]["ID"];
			if (!$ca){
				$db->insert("genre",array("LIBELLE_GENRE"=>$tag['Genre']));
				$id_genre=$db->get_insert_id();
			}

			$ca=$db->get_list("SELECT * from artiste where ARTISTE_NOM='".$tag['Author']."'");
			$id_artiste=$ca[0]["ID"];
			if (!$ca){
				$db->insert("artiste",array("ARTISTE_NOM"=>$tag['Author']));
				$id_artiste=$db->get_insert_id();
			}


			$ca=$db->get_list("SELECT * from album where ALBUM_NAME='". htmlspecialchars($tag['Album'])."'");
			$id_album=$ca[0]["ID"];
			if (!$ca){
				$db->insert("album",array("ALBUM_NAME"=> htmlspecialchars($tag['Album']),"CODE_ARTISTE"=>$id_artiste));
				$id_album=$db->get_insert_id();
			}


			$ca=$db->get_list("SELECT * from morceau where MORCEAU_NOM='". addslashes($tag['Title'])."'");
			$id_track=$ca[0]["ID"];
			if (!$ca){
				$db->insert("morceau",array("MORCEAU_NOM"=> addslashes($tag['Title']),"NO_PISTE"=>$tag->Track,"CODE_ALBUM"=>$id_album,"CODE_ARTISTE"=>$id_artiste,"CODE_GENRE"=>$id_genre,"DUREE"=>$tag['Lenght'],"ANNEE"=>$tag['Year']));
				$id_track=$db->get_insert_id();
			}


		}

}

function tagReader($file){
 $GenreLookup = array(
			0    => 'Blues',
			1    => 'Classic Rock',
			2    => 'Country',
			3    => 'Dance',
			4    => 'Disco',
			5    => 'Funk',
			6    => 'Grunge',
			7    => 'Hip-Hop',
			8    => 'Jazz',
			9    => 'Metal',
			10   => 'New Age',
			11   => 'Oldies',
			12   => 'Other',
			13   => 'Pop',
			14   => 'R&B',
			15   => 'Rap',
			16   => 'Reggae',
			17   => 'Rock',
			18   => 'Techno',
			19   => 'Industrial',
			20   => 'Alternative',
			21   => 'Ska',
			22   => 'Death Metal',
			23   => 'Pranks',
			24   => 'Soundtrack',
			25   => 'Euro-Techno',
			26   => 'Ambient',
			27   => 'Trip-Hop',
			28   => 'Vocal',
			29   => 'Jazz+Funk',
			30   => 'Fusion',
			31   => 'Trance',
			32   => 'Classical',
			33   => 'Instrumental',
			34   => 'Acid',
			35   => 'House',
			36   => 'Game',
			37   => 'Sound Clip',
			38   => 'Gospel',
			39   => 'Noise',
			40   => 'Alt. Rock',
			41   => 'Bass',
			42   => 'Soul',
			43   => 'Punk',
			44   => 'Space',
			45   => 'Meditative',
			46   => 'Instrumental Pop',
			47   => 'Instrumental Rock',
			48   => 'Ethnic',
			49   => 'Gothic',
			50   => 'Darkwave',
			51   => 'Techno-Industrial',
			52   => 'Electronic',
			53   => 'Pop-Folk',
			54   => 'Eurodance',
			55   => 'Dream',
			56   => 'Southern Rock',
			57   => 'Comedy',
			58   => 'Cult',
			59   => 'Gangsta Rap',
			60   => 'Top 40',
			61   => 'Christian Rap',
			62   => 'Pop/Funk',
			63   => 'Jungle',
			64   => 'Native American',
			65   => 'Cabaret',
			66   => 'New Wave',
			67   => 'Psychedelic',
			68   => 'Rave',
			69   => 'Showtunes',
			70   => 'Trailer',
			71   => 'Lo-Fi',
			72   => 'Tribal',
			73   => 'Acid Punk',
			74   => 'Acid Jazz',
			75   => 'Polka',
			76   => 'Retro',
			77   => 'Musical',
			78   => 'Rock & Roll',
			79   => 'Hard Rock',
			80   => 'Folk',
			81   => 'Folk/Rock',
			82   => 'National Folk',
			83   => 'Swing',
			84   => 'Fast-Fusion',
			85   => 'Bebob',
			86   => 'Latin',
			87   => 'Revival',
			88   => 'Celtic',
			89   => 'Bluegrass',
			90   => 'Avantgarde',
			91   => 'Gothic Rock',
			92   => 'Progressive Rock',
			93   => 'Psychedelic Rock',
			94   => 'Symphonic Rock',
			95   => 'Slow Rock',
			96   => 'Big Band',
			97   => 'Chorus',
			98   => 'Easy Listening',
			99   => 'Acoustic',
			100  => 'Humour',
			101  => 'Speech',
			102  => 'Chanson',
			103  => 'Opera',
			104  => 'Chamber Music',
			105  => 'Sonata',
			106  => 'Symphony',
			107  => 'Booty Bass',
			108  => 'Primus',
			109  => 'Porn Groove',
			110  => 'Satire',
			111  => 'Slow Jam',
			112  => 'Club',
			113  => 'Tango',
			114  => 'Samba',
			115  => 'Folklore',
			116  => 'Ballad',
			117  => 'Power Ballad',
			118  => 'Rhythmic Soul',
			119  => 'Freestyle',
			120  => 'Duet',
			121  => 'Punk Rock',
			122  => 'Drum Solo',
			123  => 'A Cappella',
			124  => 'Euro-House',
			125  => 'Dance Hall',
			126  => 'Goa',
			127  => 'Drum & Bass',
			128  => 'Club-House',
			129  => 'Hardcore',
			130  => 'Terror',
			131  => 'Indie',
			132  => 'BritPop',
			133  => 'Negerpunk',
			134  => 'Polsk Punk',
			135  => 'Beat',
			136  => 'Christian Gangsta Rap',
			137  => 'Heavy Metal',
			138  => 'Black Metal',
			139  => 'Crossover',
			140  => 'Contemporary Christian',
			141  => 'Christian Rock',
			142  => 'Merengue',
			143  => 'Salsa',
			144  => 'Trash Metal',
			145  => 'Anime',
			146  => 'JPop',
			147  => 'Synthpop',

			255  => 'Unknown',

			'CR' => 'Cover',
			'RX' => 'Remix'
		);
	$id3v23 = array("TIT2","TALB","TPE1","TRCK","TDRC","TLEN","USLT","TCON");
	$id3v22 = array("TT2","TAL","TP1","TRK","TYE","TLE","ULT","TCO");
	$fsize = filesize($file);
	$fd = fopen($file,"r");
	$tag = fread($fd,$fsize);
	$tmp = "";
	fclose($fd);
	if (substr($tag,0,3) == "ID3") {
		$result['FileName'] = $file;
		$result['TAG'] = substr($tag,0,3);
		$result['Version'] = hexdec(bin2hex(substr($tag,3,1))).".".hexdec(bin2hex(substr($tag,4,1)));
	}
	if($result['Version'] == "4.0" || $result['Version'] == "3.0"){
		for ($i=0;$i<count($id3v23);$i++){
			if (strpos($tag,$id3v23[$i].chr(0))!= FALSE){
				$pos = strpos($tag, $id3v23[$i].chr(0));
				$len = hexdec(bin2hex(substr($tag,($pos+5),3)));
				$data = substr($tag, $pos, 9+$len);
				for ($a=0;$a<strlen($data);$a++){
					$char = substr($data,$a,1);
					if($char >= " " && $char <= "~") $tmp.=$char;
				}

				if(substr($tmp,0,4) == "TIT2") $result['Title'] = substr($tmp,5);
				if(substr($tmp,0,4) == "TALB") $result['Album'] = substr($tmp,4);
				if(substr($tmp,0,4) == "TPE1") $result['Author'] = substr($tmp,4);
				if(substr($tmp,0,4) == "TRCK") $result['Track'] = substr($tmp,4);
				if(substr($tmp,0,4) == "TDRC") $result['Year'] = substr($tmp,4);
				if(substr($tmp,0,4) == "TLEN") $result['Lenght'] = substr($tmp,4);
				if(substr($tmp,0,4) == "USLT") $result['Lyric'] = substr($tmp,7);
				if(substr($tmp,0,4) == "TCON") $result['Genre'] = substr($tmp,4);
$result['Genre']=str_replace('(',' ',$result['Genre']);
				$result['Genre']=str_replace(')',' ',$result['Genre']);
				$result['Genre']=trim($result['Genre']);
				if (is_numeric($result['Genre'])) $result['Genre']=$GenreLookup[$result['Genre']];
				$tmp = "";
			}
		}
	}
	if($result['Version'] == "2.0"){
		for ($i=0;$i<count($id3v22);$i++){
			if (strpos($tag,$id3v22[$i].chr(0))!= FALSE){
				$pos = strpos($tag, $id3v22[$i].chr(0));
				$len = hexdec(bin2hex(substr($tag,($pos+3),3)));
				$data = substr($tag, $pos, 6+$len);
				for ($a=0;$a<strlen($data);$a++){
					$char = substr($data,$a,1);
					if($char >= " " && $char <= "~") $tmp.=$char;
				}
				if(substr($tmp,0,3) == "TT2") $result['Title'] = substr($tmp,3);
				if(substr($tmp,0,3) == "TAL") $result['Album'] = substr($tmp,3);
				if(substr($tmp,0,3) == "TP1") $result['Author'] = substr($tmp,3);
				if(substr($tmp,0,3) == "TRK") $result['Track'] = substr($tmp,3);
				if(substr($tmp,0,3) == "TYE") $result['Year'] = substr($tmp,3);
				if(substr($tmp,0,3) == "TLE") $result['Lenght'] = substr($tmp,3);
				if(substr($tmp,0,3) == "ULT") $result['Lyric'] = substr($tmp,6);
				if(substr($tmp,0,3) == "TCO") $result['Genre'] = substr($tmp,4);
				$result['Genre']=str_replace('(',' ',$result['Genre']);
				$result['Genre']=str_replace(')',' ',$result['Genre']);
				$result['Genre']=trim($result['Genre']);
				if (is_numeric($result['Genre'])) $result['Genre']=$GenreLookup[$result['Genre']];
				$tmp = "";
			}
		}
	}
	return $result;
}


