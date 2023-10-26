<?php 
use Illuminate\Support\Facades\DB;
use App\Models\EscritorioContabil;

function is_adm(){
	$usr = session('user_logged');
	return $usr['adm'];
}

function get_id_user(){
	$usr = session('user_logged');
	return $usr['id'];
}

function __replace($valor){
	return str_replace(",", ".", $valor);
}

function valida_objeto($objeto){
	$usr = session('user_logged');
	if(isset($objeto['empresa_id']) && $objeto['empresa_id'] == $usr['empresa']){
		return true;
	}else{
		return false;
	}
}

function tabelasArmazenamento(){
	// indice nome da tabela, valor em kb
	return [
		'clientes' => 5,
		'produtos' => 8,
		'fornecedors' => 4,
		'vendas' => 4,
		'venda_caixas' => 4,
		'transportadoras' => 4,
		'orcamentos' => 4,
		'categorias' => 4,
	];
}

function isSuper($login){
	$arrSuper = explode(',', getenv("USERMASTER"));

	if(in_array($login, $arrSuper)){
		return true;
	}
	return false;
}

function getSuper(){
	$arrSuper = explode(',', getenv("USERMASTER"));

	return $arrSuper[0];
}

function importaXmlSieg($file, $empresa_id){
	$escritorio = EscritorioContabil::
	where('empresa_id', $empresa_id)
	->first();

	if($escritorio != null && $escritorio->token_sieg != ""){
		$url = "https://api.sieg.com/aws/api-xml.ashx";

		$curl = curl_init();

		$headers = [];

		$data = $file;
		curl_setopt($curl, CURLOPT_URL, $url . "?apikey=".$escritorio->token_sieg."&email=".$escritorio->email);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, true );
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$xml = json_decode(curl_exec($curl));
		if($xml->Message == 'Importado com sucesso'){
			return $xml->Message;
		}
		return false;
	}else{
		return false;
	}
}


