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
		return DB::table('presencas')
		->where('presencas.abreviacao', '=', $abreviacao)
		->join('cadastros', 'cadastros.cpf', '=', 'presencas.cpf')
		->order_by('cadastros.firstnome')
		->get(array('cadastros.firstnome', 'cadastros.lastnome', 'presencas.cpf', 'presencas.presenca'));
	}

	public static function get_all_cpfs($abreviacao) {
		return DB::table('presencas')
		->where('abreviacao', '=', $abreviacao)
		->get(array('cpf'));
	}

	public static function atualizar_presenca_ok($cpf, $abreviacao) {
		return DB::table('presencas')
		->where('cpf', '=', $cpf)
		->where('abreviacao', '=', $abreviacao)
		->update(array('presenca' => '1'));
	}

	public static function atualizar_presenca_nok($cpf, $abreviacao) {
		return DB::table('presencas')
		->where('cpf', '=', $cpf)
		->where('abreviacao', '=', $abreviacao)
		->update(array('presenca' => '0'));
	}

	public static function get_certificados($cpf) {
		return DB::table('presencas')
		->where('presencas.cpf', '=', $cpf)
		->where('presencas.presenca', '=', '1')
		->join('palestras', 'palestras.abreviacao', '=', 'presencas.abreviacao')
		->get(array('presencas.abreviacao', 'palestras.nome'));
	}
}