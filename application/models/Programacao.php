<?php
class Programacao extends Eloquent {
	public static function teste($data) {
		$users = DB::table('palestras')->where(DB::raw('date(data)'), '=', $data)->order_by('data')->order_by('abreviacao')->get(
				array('data', 'abreviacao', 'nome', 'ementa', 'minicurriculo', 'pre_requisito' , 'palestrante', 'infopalestrante', 'local', 'vagas')
			);
		return $users;
	}

	public static function gerar_horario_user($cpf) {
		$users = DB::table('palestras')
		->join('presencas', 'palestras.abreviacao', '=', 'presencas.abreviacao')
		->where('presencas.cpf', '=', $cpf)
		->order_by('abreviacao')
		->get(array('palestras.data', 'palestras.abreviacao', 'palestras.nome', 'palestras.local'));
		return $users;
	}

	public static function get_palestra() {
		return DB::table('palestras')->order_by('abreviacao')->get(array('nome','abreviacao'));
	}

	public static function get_infoPalestras($abreviacao) {
		return DB::table('palestras')->where('abreviacao', '=', $abreviacao)
		->get(array('data', 'abreviacao', 'nome', 'local', 'palestrante'));
	}
}