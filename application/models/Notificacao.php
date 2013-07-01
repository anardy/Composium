<?php
class Notificacao extends Eloquent {
	public static $timestamps = false;

	public static function inserir_notificacao($new_data) {
		DB::table('notificacoes')->insert($new_data);
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
}