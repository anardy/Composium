<?php
class Realizacao extends Eloquent {
	public static $timestamps = false;

	public static function inserir_realizacao($new_data) {
		DB::table('controle_realizacao')->insert($new_data);
	}

	public static function ultimas_realizacoes($cpf) {
		return DB::table('controle_realizacao')
		->where('quem', '=', $cpf)
		->take(8)
		->get(array('data', 'oque'));
	}

	public static function ultimas_realizacoes_all() {
		return DB::table('controle_realizacao')
		->take(8)
		->get(array('data', 'oque', 'quem'));
	}
}