<?php
class Voluntario extends Eloquent {
	public static $timestamps = false;

	public static function inserir_voluntario($new_data) {
		DB::table('voluntarios')->insert($new_data);
	}

	public static function get_voluntarios() {
		return DB::table('voluntarios')->where('status', '=', '0')->paginate(5);
	}

	public static function count_voluntarios() {
		return DB::table('voluntarios')->count();
	}

	public static function get_voluntario($cpf) {
		return DB::table('voluntarios')->where('cpf', '=', $cpf);
	}

	public static function autoriza_voluntario($cpf) {
		DB::table('voluntarios')->where('cpf', '=', $cpf)->update(array('status' => '1'));
	}
}