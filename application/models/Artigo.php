<?php
class Artigo extends Eloquent {
	public static $timestamps = false;

	public static function inserir_artigo($cpf, $titulo, $autores, $resumo, $palavrachave, $nome_arquivo) {
		DB::table('artigos')->insert(array('cpf' => $cpf, 'titulo' => $titulo, 'autores' => $autores,
		 'resumo' => $resumo, 'palavrachave' => $palavrachave, 'nome_arquivo' => $nome_arquivo, 'status' => '0'));
	}

	public static function get_all_artigos() {
		return DB::table('artigos')->paginate(5);
	}

	public static function get_artigo($cpf) {
		return DB::table('artigos')->where('cpf', '=', $cpf)->get();
	}

	public static function aprovar_artigo($cpf) {
		DB::table('artigos')->where('cpf', '=', $cpf)->update(array('status' => '1'));
	}

	public static function count_artigos() {
		return DB::table('artigos')->count();
	}
}