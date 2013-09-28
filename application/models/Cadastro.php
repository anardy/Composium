<?php
class Cadastro extends Eloquent {
	public static $timestamps = false;

	public static function pesquisa_usuario_calculo($cpf) {
		return DB::table('cadastros')->where('cpf', '=', $cpf)->get(
				array('instituicao', 'curso')
			);
	}

	public static function remover_usuario($cpf) {
		DB::table('cadastros')
		->where('cpf', '=', $cpf)
		->delete();
	}

	public static function get_nome($cpf) {
		return DB::table('cadastros')
		->where('cpf', '=', $cpf)
		->get(array('firstnome', 'lastnome'));
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

	public static function atualizar_dados($cpf, $new_date) {
		DB::table('cadastros')->where('cpf', '=', $cpf)->update($new_date);
	}

	public static function grafico_porcuros() {
		return json_encode(DB::query("select DISTINCT count(a.cpf) as value, a.curso as label from cadastros a group by a.curso"));
	}

	public static function grafico_porinstituicao() {
		return json_encode(DB::query("select DISTINCT count(a.cpf) as value, a.instituicao as label from cadastros a group by a.instituicao"));
	}
}