<?php
class Cadastro extends Eloquent {
	public static $timestamps = false;

	public static function pesquisa_usuario_calculo($cpf) {
		$users = DB::table('cadastros')->where('cpf', '=', $cpf)->get(
				array('instituicao', 'curso')
			);
		return $users;
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
}