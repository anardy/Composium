<?php
class Reinscricao extends Eloquent {
	public static $timestamps = false;

	public static function inserir_reinscricao($cpf) {
		DB::table('reinscricoes')->insert(array('cpf' => $cpf, 'status' => '0'));
	}

	public static function get_reinscricoes() {
		return DB::table('reinscricoes')->where('status', '=', '0')->paginate(5);
	}

	public static function get_reinscricao_user($cpf) {
		return DB::table('reinscricoes')->where('cpf', '=', $cpf)->where('status', '=', '0')->count();
	}

	public static function autoriza_reinscricao($cpf) {
		DB::table('reinscricoes')->where('cpf', '=', $cpf)->update(array('status' => '1'));
	}
}