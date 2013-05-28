<?php
class Cadastro extends Eloquent {
	public static $timestamps = false;
	public static function pesquisa_usuario_calculo($cpf) {
		$users = DB::table('cadastros')->where('cpf', '=', $cpf)->get(
				array('instituicao', 'curso')
			);
		return $users;
	}
}