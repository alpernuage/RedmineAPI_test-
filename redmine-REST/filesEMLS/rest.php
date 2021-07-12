<?php
Atomik::needed('PHPRestClient/restclient');

/*
Liste des APIs référencées
*/
Atomik::set('REST/SendInBlue/options',array(
	'base_url' => 'https://api.sendinblue.com/v3',
	'headers' => array(
		'accept' => 'application/json',
		'content-type' => 'application/json',
		'api-key' => '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',
	),
	'curl_options' => array(
		CURLOPT_TIMEOUT => 30,
	),
));

// Initialise l'API REST $id (déjà référencée ou non)
function RESTInit($id,$options=array()){
	Atomik::set('REST/'.$id.'/api',new RestClient(array_merge(
		A('REST/'.$id.'/options',array()),
		// Retourne des tableaux au lieu d'objets
		array(
			'decoders' => array(
				'json' => function($data){
					return json_decode($data,true);
			}),
		),
		$options
	)));
}

// Envoie un GET / POST / PUT / DELETE à l'API REST $id et renvoie le code HTTP de l'exécution.
// Paramètres :
// - $params :
//   + si la valeur est un tableau alors elle est convertie en chaîne avec http_build_query()
//   + on peut utiliser json_encode() avant pour avoir une chaîne au format JSON
// Valeurs renseignées dans le tableau Atomik :
// - REST/$id/timeout : booleen pour indiquer si un timeout est survenu
// - REST/$id/resultat : objet complet
// - REST/$id/reponse : tableau contenant la réponse
function RESTGet($id,$url,$params=array(),$headers=array()){
	return _traiterResultat($id,A('REST/'.$id.'/api')->get($url,$params,$headers));
}

// Voir fonction RESTGet()
function RESTPost($id,$url,$params=array(),$headers=array()){
	return _traiterResultat($id,A('REST/'.$id.'/api')->post($url,$params,$headers));
}

// Voir fonction RESTGet()
function RESTPut($id,$url,$params=array(),$headers=array()){
	return _traiterResultat($id,A('REST/'.$id.'/api')->put($url,$params,$headers));
}

// Voir fonction RESTGet()
function RESTDelete($id,$url,$params=array(),$headers=array()){
	return _traiterResultat($id,A('REST/'.$id.'/api')->delete($url,$params,$headers));
}

// Transforme de manière récursive un tableau en objet
function array_to_object($d) {
    return is_array($d) ? (object) array_map(__FUNCTION__, $d) : $d;
}

// Fonction interne appelée par les fonctions RESTGet, RESTPost, RESTPut, RESTDelete
function _traiterResultat($id,$resultat){
	Atomik::set('REST/'.$id.'/resultat',$resultat);
	Atomik::set('REST/'.$id.'/timeout',($resultat->error==CURLE_OPERATION_TIMEDOUT));
	$reponse = array();
	if ($resultat->response!=''){
		$reponse = $resultat->decode_response();
		try {
		} catch (Exception $e){
			$reponse['message'] = $e->getMessage();
		}
	}
	Atomik::set('REST/'.$id.'/reponse',$reponse);
	return $resultat->info->http_code;
}

?>
