<?php
class Perfil extends Eloquent {
	public static $timestamps = false;

	public static function eh_admin($cpf) {
		return DB::table('perfis')->where('cpf', '=', $cpf)->get(array('perfil'));
	}

	public static function alterar_perfil($cpf, $perfil) {
		return DB::table('perfis')->where('cpf', '=', $cpf)->update(array('perfil' => $perfil));
	}

	public static function inserir_perfil($data) {
		DB::table('perfis')->insert($data);
	}

	public static function remover_perfil($cpf) {
		DB::table('perfis')->where('cpf', '=', $cpf)->delete();
	}
}