<?php
class Administrador_Controller extends Base_Controller {
	public $restful = true;

	public function get_administrador() {
		$data = array(
				'c_users' => Cadastro::count_users(),
				'ultimos_users' => Cadastro::ultimos_users(),
				'ultimas_realizacoes' => Realizacao::ultimas_realizacoes_all()
			);
		return View::make('perfis.admin.home', $data);
	}

	/* Acesso a View Programação */
	public function get_programacao() {
		// Dados da programação vindo da Base de Dados que serão exibidos na página
		$data = array(
				'primeiro' => Programacao::teste('2012-04-16'),
				'segundo'  => Programacao::teste('2012-04-17'),
				'terceiro' => Programacao::teste('2012-04-18')
			);
		return View::make('perfis.admin.programacao', $data);
	}

	/* Acesso a View Perfis */
	public function get_perfis() {
		$data = array(
				'registros' => Perfil::busca_perfis(Input::get('cpf'))
			);
		return View::make('perfis.admin.perfis', $data);
	}

	public function post_perfis() {
		$data = array(
				'registros' => Perfil::busca_perfis(Input::get('cpf'))
			);
		return View::make('perfis.admin.perfis', $data);
	}

	public function get_CadPerfil() {
		return View::make('perfis.admin.CadPerfil');
	}

	public function post_CadPerfil() {
		$new_date = array(
			'cpf' => Input::get('cpf'),
			'perfil' => Input::get('perfil')
		);

		$regras = array('cpf' => 'required');

		$v = Validator::make($new_date, $regras);

		if ($v->fails()) {
			return Redirect::to('cadPerfil')->with_errors($v)->with_input();
		}

		Perfil::inserir_perfil($new_date);
		return Redirect::to_action('administrador@perfis');
	}

	public function get_RemPerfil($cpf, $perfil) {
		if ((isset($cpf)) || (isset($perfil))) {
			Perfil::remover_perfil($cpf, $perfil);
		}
		return Redirect::to_action('administrador@perfis');
	}

	public function get_AltPerfil($cpf, $perfil) {
		$data = array(
				'cpf' => $cpf,
				'perfil' => $perfil
			);
		return View::make('perfis.admin.AltPerfil', $data);
	}

	public function post_AltPerfil() {
		Perfil::alterar_perfil(Input::get('cpf'),Input::get('perfilantigo'), Input::get('perfilnovo'));
		return Redirect::to_action('administrador@perfis');
	}

	/* Acesso a View Usuários */
	public function get_usuarios() {
		$data = array(
				'registros' => Inscricao::busca_cpf(Input::get('cpf'))
			);
		return View::make('perfis.admin.usuarios', $data);
	}

	/* Acesso a busca de Usuários por CPF */
	public function post_usuarios() {
		$data = array(
				'registros' => Inscricao::busca_cpf(Input::get('cpf'))
			);
		return View::make('perfis.admin.usuarios', $data);
	}

	/* Visão detalhada, em modal, de um usuário especifico, pelo CPF */
	public function get_ConUsuario($cpf) {
		if (isset($cpf)) {
			$data = array(
					'results' => Cadastro::get_dados($cpf)
				);
			return View::make('perfis.admin.conUsuario', $data);
		}
	}

	public function get_RemUsuario($cpf) {
		if (isset($cpf)) {
			Cadastro::remover_usuario($cpf);
		}
		return Redirect::to_action('administrador@usuarios');
	}

	/* Acesso a View Manutenção */
	public function get_manutencao() {
		$data = array(
				'manutencao' => Manutencao::get_manutencao(),
				'desativar' => Manutencao::get_desativar()
			);
		return View::make('perfis.admin.manutencao', $data);
	}

	public function post_manutencao() {
		$manutencao = Input::get('manutencao');
		$desativar = Input::get('desativar');

		$paginas = Manutencao::get_paginas();

		$ok = array();
		$nok = array();

		foreach ($manutencao as $u) {
			array_push($ok, $u);
		}

		foreach ($desativar as $u) {
			array_push($ok, $u);
		}

		foreach ($paginas as $u) {
			array_push($nok, $u->pagina);
		}

		foreach ($nok as $key => $t) {
			foreach ($ok as $key2 => $u) {
				if ($t == $u) {
					unset($nok[$key]);
				}
			}
		}

		foreach ($nok as $u) {
			Manutencao::atualizar_manutencao_nok($u);
		}

		foreach ($ok as $u) {
			Manutencao::atualizar_manutencao_ok($u);
		}

		return Redirect::to_action('administrador@manutencao');
	}

	/* Acesso a View Galeria de Fotos */
	public function get_galeria() {
		return View::make('perfis.admin.galeria');
	}

	public function get_notificacao() {
		return View::make('perfis.admin.notificacao');	
	}
}
?>