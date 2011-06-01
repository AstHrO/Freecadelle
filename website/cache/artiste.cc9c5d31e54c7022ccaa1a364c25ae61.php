<?php if(!class_exists('raintpl')){exit;}?>

	<h1><?php echo $fiche["ARTISTE_NOM"];?></h1>
	<div class="text"><?php echo $fiche["DESC_COURT"];?></div>
<BR /><BR />Musicographie :<br/><br/>
	<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );self::$tpl_dir .= dirname("Recherche/Resultat") . ( substr("Recherche/Resultat",-1,1) != "/" ? "/" : "" );$tpl->draw( basename("Recherche/Resultat") );self::$tpl_dir = $tpl_dir_temp;?>

