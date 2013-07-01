<?php
class Perfil extends Eloquent {
	public static $timestamps = false;

	public static function eh_admin($cpf) {
		return DB::table('perfis')->where('cpf', '=', $cpf)->get(array('perfil'));
	}

	public static function alterar_perfil($cpf, $perfilantigo, $perfilnovo) {
		return DB::table('perfis')
		->where('cpf', '=', $cpf)
		->where('perfil', '=', $perfilantigo)
		->update(array('perfil' => $perfilnovo));
	}

	public static function inserir_perfil($data) {
		DB::table('perfis')->insert($data);
	}

	public static function remover_perfil($cpf, $perfil) {
		DB::table('perfis')
		->where('cpf', '=', $cpf)
		->where('perfil', '=', $perfil)
		->delete();
	}

	public static function busca_perfis($cpf) {
		return DB::table('perfis')
		->where('perfis.cpf', 'LIKE', '%'.$cpf.'%')
		->join('cadastros', 'perfis.cpf', '=', 'cadastros.cpf')
		->paginate(7);
	}
}