<?php
class Cadastro extends Eloquent {
	public static $timestamps = false;

	public static function pesquisa_usuario_calculo($cpf) {
		$users = DB::table('cadastros')->where('cpf', '=', $cpf)->get(
				array('instituicao', 'curso')
			);
		return $users;
	}

	public static function remover_usuario($cpf) {
		DB::table('cadastros')
		->where('cpf', '=', $cpf)
		->delete();
	}

	public static function get_nome($cpf) {
		return DB::table('cadastros')->where('cpf', '=', $cpf)->get(array('firstnome', 'lastnome'));
	}

	public static function get_valida($cpf) {
		return DB::table('cadastros')->where('cpf', '=', $cpf)->count();
	}

	public static function get_dados($cpf) {
		return DB::table('cadastros')->where('cpf', '=', $cpf)->get();
	}

	public static function count_users() {
		return DB::table('cadastros')->count();
	}

	public static function ultimos_users() {
		return DB::table('cadastros')->take(8)->get(array('data', 'firstnome', 'lastnome'));
	}
}