<?php
	if (!defined("_ECRIRE_INC_VERSION")) return;
	
	include_spip('inc/config');

	define('UPDATEHEADERS_DEFAULT',	'Hidden');

	function updateheaders_affichage_entetes_final($entetes){
		//	On récupère les données enregistrées en base
		$default	=	lire_config('updateheaders/default_replace');
		if(!$default)
			$default	=	UPDATEHEADERS_DEFAULT;
		$powered	=	lire_config('updateheaders/masquer_powered');
		$composed	=	lire_config('updateheaders/masquer_composed');
		$advanced	=	lire_config('updateheaders/advanced');
		
		//	On assigne les valeurs des cases cochées
		if($powered)
			$entetes['X-Powered-By']	=	$default;
		if($composed)
			$entetes['Composed-By']		=	$default;
		
		//	On assigne les valeurs de la conf avancée
		if($advanced) {
			$advanced		=	str_replace("\n", '&', $advanced);
			parse_str($advanced, $tab_advanced);
			foreach($tab_advanced as $key => $value)
			{
				if(empty($value))
				{
					$tab_advanced[$key]	=	$default;
				}
			}
			$entetes	=	array_merge($entetes, $tab_advanced);
		}
		return $entetes;
	}
?>