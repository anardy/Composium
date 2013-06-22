<?php
class Inscricao extends Eloquent {
	public static $timestamps = false;
	
	public static function inserir_inscricao($cpf, $total) {
		DB::table('inscricoes')->insert(array('cpf' => $cpf, 'status' => '0', 'valor' => $total));
	}

	public static function excluir_inscricao($cpf) {
		DB::table('inscricoes')->where('cpf', '=', $cpf)->delete();
	}

	public static function busca_inscricao($cpf) {
		return DB::table('inscricoes')->where('cpf', '=', $cpf)->count('cpf');
	}

	public static function user_pagou($cpf) {
		return DB::table('inscricoes')->where('cpf', '=', $cpf)->get(array('status'));
	}

	public static function confirma_pgto_user($cpf) {
		DB::table('inscricoes')->where('cpf', '=', $cpf)->update(array('status' => '1'));
	}

	public static function busca_cpf($cpf) {
		return DB::table('inscricoes')
		->where('inscricoes.cpf', 'LIKE', '%'.$cpf.'%')
		->join('cadastros', 'inscricoes.cpf', '=', 'cadastros.cpf')
		->paginate(7);
	}

	public static function busca_pgto_cpf($cpf) {
		return DB::table('inscricoes')
		->where('inscricoes.cpf', 'LIKE', '%'.$cpf.'%')
		->where('status', '=', '0')
		->join('cadastros', 'inscricoes.cpf', '=', 'cadastros.cpf')
		->paginate(7);
	}
}