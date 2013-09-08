<?php
class Notificacao extends Eloquent {
	public static $timestamps = false;

	public static function inserir_notificacao($new_data) {
		DB::table('notificacoes')->insert($new_data);
	}

	public static function count_notificacao_total_user($cpf) {
		return DB::table('notificacoes')
		->where('destinatario', '=', $cpf)
		->where('perfil', '=', 'usuario')
		->count();
	}

	public static function count_notificacao_novas_user($cpf) {
		return DB::table('notificacoes')
		->where('destinatario', '=', $cpf)
		->where('perfil', '=', 'usuario')
		->where('status', '=', '0')
		->count();
	}

	public static function count_notificacao_user($cpf) {
		return DB::table('notificacoes')
		->where('destinatario', '=', $cpf)
		->where('perfil', '=', 'usuario')
		->count();
	}

	public static function new_notificacao_user($cpf) {
		return DB::table('notificacoes')
		->where('perfil', '=', 'usuario')
		->where('notificacoes.destinatario', '=', $cpf)
		->where('notificacoes.status', '=', '0')
		->join('mensagens', 'mensagens.codigo', '=', 'notificacoes.mensagem')
		->order_by('notificacoes.data', 'desc')
		->get(array('mensagens.mensagem'));
	}

	public static function notificacao_user($cpf) {
		return DB::table('notificacoes')
		->where('perfil', '=', 'usuario')
		->where('notificacoes.destinatario', '=', $cpf)
		->where('notificacoes.status', '=', '1')
		->join('mensagens', 'mensagens.codigo', '=', 'notificacoes.mensagem')
		->order_by('notificacoes.data', 'desc')
		->take(3)
		->get(array('mensagens.mensagem'));
	}

	public static function atualizar_notificacao($cpf) {
		DB::table('notificacoes')->where('cpf', '=', $cpf)->update(array('status' => '1'));
	}

	public static function count_notificacao_total_rh() {
		return DB::table('notificacoes')
		->where('perfil', '=', 'rh')
		->count();
	}

	public static function count_notificacao_rh() {
		return DB::table('notificacoes')
		->where('perfil', '=', 'rh')
		->count();
	}

	public static function count_notificacao_novas_rh() {
		return DB::table('notificacoes')
		->where('perfil', '=', 'rh')
		->where('status', '=', '0')
		->count();
	}

	public static function new_notificacao_rh() {
		return DB::table('notificacoes')
		->where('notificacoes.perfil', '=', 'rh')
		->where('notificacoes.status', '=', '0')
		->join('mensagens', 'mensagens.codigo', '=', 'notificacoes.mensagem')
		->order_by('notificacoes.data', 'desc')
		->get(array('mensagens.mensagem'));
	}

	public static function notificacao_rh() {
		return DB::table('notificacoes')
		->where('notificacoes.perfil', '=', 'rh')
		->where('notificacoes.status', '=', '1')
		->join('mensagens', 'mensagens.codigo', '=', 'notificacoes.mensagem')
		->order_by('notificacoes.data', 'desc')
		->take(3)
		->get(array('mensagens.mensagem'));
	}
}