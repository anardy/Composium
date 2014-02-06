<?php
class Artigo extends Eloquent {
	public static $timestamps = false;

	public static function inserir_artigo($cpf, $titulo, $autores, $resumo, $palavrachave, $nome_arquivo, $data) {
		DB::table('artigos')->insert(array('cpf' => $cpf, 'titulo' => $titulo, 'autores' => $autores,
		 'resumo' => $resumo, 'palavrachave' => $palavrachave, 'nome_arquivo' => $nome_arquivo, 'status' => '0',
		 'dataenvio' => $data, 'datarevisao' => null));
	}

	public static function get_all_artigos() {
		return DB::table('artigos')
		->join('cadastros', 'cadastros.cpf', '=', 'artigos.cpf')
		->paginate(5, array('artigos.cpf', 'artigos.titulo', 'artigos.dataenvio', 'cadastros.firstnome', 'cadastros.lastnome', 'artigos.datarevisao', 'artigos.nome_arquivo', 'artigos.status'));
	}

	public static function get_artigo($cpf) {
		return DB::table('artigos')
		->where('artigos.cpf', '=', $cpf)
		->join('cadastros', 'cadastros.cpf', '=', 'artigos.cpf')
		->get(array('artigos.titulo', 'artigos.autores', 'artigos.resumo', 'artigos.palavrachave', 'cadastros.firstnome', 'cadastros.lastnome', 'artigos.status'));
	}

	public static function aprovar_artigo($cpf) {
		DB::table('artigos')->where('cpf', '=', $cpf)->update(array('status' => '1'));
	}

	public static function reprovar_artigo($cpf) {
		DB::table('artigos')->where('cpf', '=', $cpf)->update(array('status' => '2'));
	}

	public static function count_artigos() {
		return DB::table('artigos')->count();
	}

	public static function get_manutencao() {
		return DB::table('manutencao')
		->where('pagina', '=', 'Submissão de Artigos')
		->get(array('status'));
	}

	public static function revisar_artigo($cpf, $quem, $data) {
		return DB::table('artigos')
		->where('cpf', '=', $cpf)
		->update(array(
					'revisor' => $quem,
					'datarevisao' => $data
					)
				);
	}
}