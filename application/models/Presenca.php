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

	public static function get_presentes($abreviacao) {
		return DB::table('presencas')
		->where('abreviacao', '=', $abreviacao)
		->where('presenca', '=', '1')
		->count('presenca');
	}

	public static function get_ausentes($abreviacao) {
		return DB::table('presencas')
		->where('abreviacao', '=', $abreviacao)
		->where('presenca', '=', '0')
		->count('presenca');
	}

	public static function nrototal_abreviacao($abreviacao) {
		return DB::table('presencas')
		->where('presencas.abreviacao', '=', $abreviacao)
		->count();
	}

	public static function get_graph() {
		return DB::query("select date_format(data, '%Y-%m-%d') as data, count(a.cpf) as valor from presencas a, palestras b
where a.abreviacao = b.abreviacao and
      a.presenca = 1
group by day(b.data)");
	}

	public static function get_bestpresenca() {
		return DB::query('select b.abreviacao, b.nome, count(a.presenca) as valor from presencas a, palestras b
where a.abreviacao = b.abreviacao
group by (b.abreviacao)
order by rand() desc LIMIT 10');
	}

	public static function get_maisprocurados() {
		return DB::query("select a.abreviacao, count(a.cpf) as total, b.nome from presencas a, palestras b
where a.abreviacao = b.abreviacao group by a.abreviacao order by total desc limit 10");
	}

	public static function get_all_presentes() {
		return DB::table('presencas')
		->where('presenca', '=', '1')
		->count('presenca');
	}

	public static function get_all_ausentes() {
		return DB::table('presencas')
		->where('presenca', '=', '0')
		->count('presenca');
	}

	public static function get_total() {
		return DB::table('presencas')
		->count('presenca');
	}
}