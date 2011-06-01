<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="Content-type" content="text/html" charset="UTF-8"/>
<html lang="fr">
<head>
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="http://asthro.hd.free.fr/fricadelle/application/views/css/style.css" type="text/css" />
	<link rel="stylesheet" href="http://asthro.hd.free.fr/fricadelle/application/views/css/demo_table.css" type="text/css" />
	<script type="text/javascript" href="js/jquery/jquery.min.js"></script>	
	<!-- Style & Script -->
	<?php echo $head;?>

	<!-- // -->

</head>
<body>
<div id="container" >
	<div id="header" class="doc">
		<div id="menu">
			
			<img src="http://asthro.hd.free.fr/fricadelle/application/views/img/logo.png" height=80 style="margin-top:0px;padding:0">
			<?php $counter1=-1; if( isset($menu) && is_array($menu) && sizeof($menu) ) foreach( $menu as $key1 => $value1 ){ $counter1++; ?>

			<a href="http://asthro.hd.free.fr/fricadelle/<?php echo $value1["link"];?>" <?php echo $value1["selected"]?'class="selected"':null;?>><?php echo $value1["name"];?></a>
			<?php } ?>

		</div>
	</div>
	<div id="shadow"></div>
	<div id="wrapper">
		<div id="content">
			<div id="section" class="doc">
				<div id="section_inside">
					<div id="section_inside_inside">
						<?php echo $load_area["center"];?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="navigation">
	<div id="infos">
			<span class="" >Durée : </span><span  class="">00 : 00 </span>
			<br /><span class="">Pistes : </span><span  class="">0 </span>
			<br /><span class="">Artistes : </span><span  class="">0 </span>
	</div>
<div id="liste">
		<ul>
		<?php $counter1=-1; if( isset($playlist) && is_array($playlist) && sizeof($playlist) ) foreach( $playlist as $key1 => $value1 ){ $counter1++; ?>

			<li>
			<a class="" href="http://asthro.hd.free.fr/fricadelle/index.php/Playlist/del/<?php echo $value1["CODE_MORCEAU"];?>/">X</a>
			<span style="width:100px" class=""><?php echo ( substr( $value1["ARTISTE_NOM"], 0,13 ) );?></span>
			<span style="width:120px" class=""><?php echo ( substr( $value1["MORCEAU_NOM"], 0,15 ) );?></span> 
			<span style="width:40px" class="time"><?php echo ( substr( $value1["DUREE"], 0,5 ) );?></span>
			</li>
		<?php } ?>

		</ul>
</div>
<div id="controls">
		<a href="http://asthro.hd.free.fr/fricadelle/" class="large awesome red" >Graver</A><br/><br/>		
		<a class="small awesome orange"  href="http://asthro.hd.free.fr/fricadelle/index.php/Playlist/vider/">Vider</a>
</div>
	</div>
	
	<div id="footer">
		<div id="inner_footer">
			<div class="left"></div>
		        <div class="center">execution time: <?php echo $execution_time;?> queries: <?php echo $n_query;?></div>
			<div class="right">Thomas HOCEDEZ/Chtinux</div>
		</div>
	</div>
</div>
</body>



	
</html>



