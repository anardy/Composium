<?php
class Presenca extends Eloquent {
	public static $timestamps = false;

	public static function inserir_presenca($cpf, $palestra) {
		DB::table('presencas')->insert(array('cpf' => $cpf, 'abreviacao' => $palestra, 'presenca' => 0));
	}
	
	public static function excluir_presenca($cpf) {
		DB::table('presencas')->where('cpf', '=', $cpf)->delete();
	}

	public static function buscar_presenca($cpf) {
		return DB::table('presencas')->join('palestras', 'palestras.abreviacao', '=', 'presencas.abreviacao')
		->where('presencas.cpf', '=', $cpf)->get(array('presencas.abreviacao', 'palestras.nome',
		 'presencas.presenca'));
	}

	public static function nrototal_presenca() {
		return DB::table('presencas')->where('presenca', '=', '1')->count();
	}

	public static function nrototal() {
		return DB::table('presencas')->count();
	}

	public static function nrouser_presencauser($cpf) {
		return DB::table('presencas')->where('cpf', '=', $cpf)->where('presenca', '=', '1')->count();
	}

	public static function nrototal_user($cpf) {
		return DB::table('presencas')->where('cpf', '=', $cpf)->count();
	}

	public static function lista_participantes($abreviacao) {
		return DB::table('presencas')->join('cadastros', 'cadastros.cpf', '=', 'presencas.cpf')
		->where('presencas.abreviacao', '=', $abreviacao)
		->get(array('cadastros.firstnome'));
	}

	public static function lista_presenca($abreviacao) {
		return DB::table('presencas')->join('cadastros', 'cadastros.cpf', '=', 'presencas.cpf')
		->where('presencas.abreviacao', '=', $abreviacao)
		->get(array('cadastros.firstnome', 'cadastros.lastnome'));
	}
}