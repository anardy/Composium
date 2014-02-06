<?php
class Reinscricao extends Eloquent {
	public static $timestamps = false;

	public static function inserir_reinscricao($cpf) {
		DB::table('reinscricoes')->insert(array('cpf' => $cpf, 'status' => '0'));
	}

	public static function get_reinscricoes_teste($cpf) {
		return DB::table('reinscricoes')
		->select(array(DB::raw('count(cpf) as qnt, data')))
		->where('cpf', '=', $cpf)
		->get(array('qnt'));
	}

	public static function get_reinscricoes() {
		return DB::table('reinscricoes')
		->select(array(DB::raw('distinct reinscricoes.cpf, cadastros.firstnome, cadastros.lastnome, cadastros.email')))
		->where('status', '=', '0')
		->join('cadastros', 'reinscricoes.cpf', '=', 'cadastros.cpf')
		->paginate(5);
	}

	public static function get_reinscricao_user($cpf) {
		return DB::table('reinscricoes')->where('cpf', '=', $cpf)->where('status', '=', '0')->count();
	}

	public static function autoriza_reinscricao($cpf) {
		DB::table('reinscricoes')->where('cpf', '=', $cpf)->update(array('status' => '1'));
	}

	public static function count_reinscricao() {
		return DB::table('reinscricoes')->count();
	}

	public static function busca_reinscricoes($nome) {
		return DB::table('reinscricoes')
		->where('cadastros.firstnome', 'LIKE', '%'.$nome.'%')
		->join('cadastros', 'reinscricoes.cpf', '=', 'cadastros.cpf')
		->paginate(5);
	}
}