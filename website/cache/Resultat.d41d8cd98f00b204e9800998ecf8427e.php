<?php if(!class_exists('raintpl')){exit;}?>

<table id="dtt" cellspacing=0 cellpadding=0 style="width:40%" width=400>
<thead>
<tr>
	<th></th>
		
	<th>Artiste</th>
	<th>Titre</th>
	<th>Album</th>
	<!--<th>Genre</th>-->
	<th>Durée</th>
</tr>
</THEAD>
<tbody>
<?php $counter1=-1; if( isset($resultat) && is_array($resultat) && sizeof($resultat) ) foreach( $resultat as $key1 => $value1 ){ $counter1++; ?>

<tr>
	<td ><a class="small awesome green" href="http://asthro.hd.free.fr/fricadelle/index.php/Playlist/add/<?php echo $value1["mID"];?>/" >+</a></td>
	<td ><a href="http://asthro.hd.free.fr/fricadelle/index.php/Fiche/Artiste/<?php echo $value1["aID"];?>/"><?php echo ( substr( $value1["ARTISTE_NOM"], 0,15 ) );?></a></td>
	<td ><?php echo ( substr( $value1["MORCEAU_NOM"], 0,30 ) );?></td>
	<td ><a href="http://asthro.hd.free.fr/fricadelle/index.php/Recherche/par_album/<?php echo $value1["CODE_ALBUM"];?>/"><?php echo ( substr( $value1["ALBUM_NAME"], 0,10 ) );?></td>
<!--	<td ><a href="http://asthro.hd.free.fr/fricadelle/index.php/Recherche/par_genre/<?php echo $value1["LIBELLE_GENRE"];?>/"><?php echo ( substr( $value1["LIBELLE_GENRE"], 0,10 ) );?></td>-->
	<td ><?php echo $value1["DUREE"];?></td>
</tr>
<?php } ?>

</tbody>
<tfoot>
</tfoot>
</table>

<script>
	$("#dtt").dataTable({
	"sScrollY": "250",
	"iDisplayLength": 9999,
	"bScrollCollapse": true});
</script>
