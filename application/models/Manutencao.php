<?php
class Manutencao extends Eloquent {
	public static $timestamps = false;

	public static function get_paginas() {
		return DB::table('manutencao')->get(array('pagina'));
	}

	public static function atualizar_manutencao_ok($pagina) {
		return DB::table('manutencao')
		->where('pagina', '=', $pagina)
		->update(array('status' => '1'));
	}

	public static function atualizar_manutencao_nok($pagina) {
		return DB::table('manutencao')
		->where('pagina', '=', $pagina)
		->update(array('status' => '0'));
	}

	public static function get_manutencao() {
		return DB::table('manutencao')
		->where('manutencao', '=', false)
		->get(array('pagina', 'status'));
	}

	public static function get_desativar() {
		return DB::table('manutencao')
		->where('manutencao', '=', true)
		->get(array('pagina', 'status'));
	}
}
?>