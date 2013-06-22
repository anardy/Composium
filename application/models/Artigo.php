<?php
class Artigo extends Eloquent {
	public static $timestamps = false;

	public static function inserir_artigo($cpf, $titulo, $autores, $resumo, $palavrachave, $nome_arquivo) {
		DB::table('artigos')->insert(array('cpf' => $cpf, 'titulo' => $titulo, 'autores' => $autores,
		 'resumo' => $resumo, 'palavrachave' => $palavrachave, 'nome_arquivo' => $nome_arquivo, 'status' => '0'));
	}

	public static function get_all_artigos() {
		return DB::table('artigos')->get();
	}

	public static function get_artigos_total() {
		return DB::table('artigos')->count();
	}
}