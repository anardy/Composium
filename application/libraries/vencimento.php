<?php
class Vencimento {
	//FORMATA COMO TIMESTAMP
	public static function dataToTimestamp($data){
		$ano = substr($data, 6,4);
		$mes = substr($data, 3,2);
		$dia = substr($data, 0,2);
		return mktime(0, 0, 0, $mes, $dia, $ano);  
	}

	public static function Soma1dia($data){
		$ano = substr($data, 6,4);
		$mes = substr($data, 3,2);
		$dia = substr($data, 0,2);
		return date("d/m/Y", mktime(0, 0, 0, $mes, $dia+1, $ano));
	}

	//LISTA DE FERIADOS NO ANO
	public static function Feriados($ano,$posicao){
		$dia = 86400;
		$datas = array();
		$datas['pascoa'] = easter_date($ano);
		$datas['sexta_santa'] = $datas['pascoa'] - (2 * $dia);
		$feriados = array();
		array_push($feriados, date('d/m',$datas['sexta_santa']));
		array_push($feriados, date('d/m',$datas['pascoa']));
		return $feriados[$posicao]."/".$ano;
	}

	public static function SomaDiasUteis(){
		$xDataInicial = date("d/m/Y");
		$xSomarDias = 3;
		for($ii=1; $ii<=$xSomarDias; $ii++){
			$xDataInicial=static::Soma1dia($xDataInicial); //SOMA DIA NORMAL
			//VERIFICANDO SE EH DIA DE TRABALHO
			if(date("w", static::dataToTimestamp($xDataInicial))=="0"){
				//SE DIA FOR DOMINGO OU FERIADO, SOMA +1
				$xDataInicial=static::Soma1dia($xDataInicial);
			}else if(date("w", static::dataToTimestamp($xDataInicial))=="6"){
				//SE DIA FOR SABADO, SOMA +2
				$xDataInicial=static::Soma1dia($xDataInicial);
				$xDataInicial=static::Soma1dia($xDataInicial);
			}else{
				//senão vemos se este dia eh FERIADO
				for($i=0; $i<=1; $i++){
					if($xDataInicial==static::Feriados(date("Y"),$i)){
						$xDataInicial=static::Soma1dia($xDataInicial);
					}
         		}
      		}
   		}
		return $xDataInicial;
	}

	//if (($DataInicial == '11/04/2012') || ($DataInicial == '12/04/2012') || ($DataInicial == '13/04/2012')) {
	//$diasSomados = '13/04/2012';
	//}else
}
?>