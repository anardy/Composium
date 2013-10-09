<?php
class RH_Controller extends Base_Controller {
	public $restful = true;

	/* Acesso a View RH */
	public function get_rh() {
		$data = array(
				'c_voluntarios' => Voluntario::count_voluntarios(),
				'c_reinscricao' => Reinscricao::count_reinscricao(),
				'c_users' => Cadastro::count_users(),
				'ultimos_users' => Cadastro::ultimos_users(),
				'ultimas_realizacoes' => Realizacao::ultimas_realizacoes(Auth::user()->cpf)
			);
		return View::make('perfis.rh.home', $data);
	}

	/* Acesso a View Pagamento */
	public function get_pagamento() {
		$data = array(
				'registros' => Inscricao::busca_pgto_cpf(Input::get('cpf')),
				'cell' => Session::get('cell')
			);

		return View::make('perfis.rh.pagamento', $data);
	}

	/* Busca por CPF na View Pagamento */
	public function post_pagamento() {
		$data = array(
				'registros' => Inscricao::busca_pgto_cpf(Input::get('cpf')),
				'cell' => Session::get('cell')
			);

		return View::make('perfis.rh.pagamento', $data);
	}

	/* Efetuar pagamento do Usuário na View Pagamento */
	public function post_efetuarpagamento() {
		$cpf = Input::get('cpf');
		Session::put('cell', $cpf);
		$new_date = array(
			'destinatario' => $cpf,
			'perfil' => 'usuario',
			'mensagem' => '5'
			);
		$realizacao = array(
			'quem' => Auth::user()->cpf,
			'oque' => 'Realizou o pagamento do usuário ' . $cpf
			);
		Inscricao::confirma_pgto_user($cpf);
		Notificacao::inserir_notificacao($new_date);
		Realizacao::inserir_realizacao($realizacao);
		return Redirect::to_action('rh@pagamento');
	}

	/* Acesso a View Presença */
	public function get_presenca() {
		$array = array();
		foreach(Programacao::get_palestra() as $p) {
			$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
		}
		$data = array(
				'palestras' => $array
			);

		return View::make('perfis.rh.presenca', $data);
	}

	/* Realiza presença dos usuários nas palestras e minicursos */
	public function post_presenca() {
		$participantes = Input::get('participantes');
		$abreviacao = Input::get('abreviacao');

		$todos = Presenca::get_all_cpfs($abreviacao);

		$foram = array();
		$naoforam = array();

		foreach ($participantes as $u) {
			array_push($foram, $u);
		}

		foreach ($todos as $u) {
			array_push($naoforam, $u->cpf);
		}

		foreach ($naoforam as $key => $t) {
			foreach ($foram as $key2 => $u) {
				if ($t == $u) {
					unset($naoforam[$key]);
				}
			}
		}
		$realizacao_nok = array();
		foreach ($naoforam as $u) {
			Presenca::atualizar_presenca_nok($u, $abreviacao);
			$realizacao_nok[] = array(
				'quem' => Auth::user()->cpf,
				'oque' => 'Removeu presença do usuário ' . $u . ' da ' . $abreviacao
			);
		}
		Realizacao::inserir_realizacao($realizacao_nok);
		$realizacao_ok = array();
		foreach ($foram as $u) {
			Presenca::atualizar_presenca_ok($u, $abreviacao);
			$realizacao_ok[] = array(
				'quem' => Auth::user()->cpf,
				'oque' => 'Lançou presença do usuário ' . $u . ' para ' . $abreviacao
			);
		}
		Realizacao::inserir_realizacao($realizacao_ok);
	
		return Redirect::to_action('rh@presenca');
	}

	/* Listar os participantes da palestra ou minicurso escolhido na View Presença */
	public function post_listapresenca() {
		$data = array(
				'participantes' => Presenca::lista_participantes(Input::get('abreviacao')),
				'palestra' => Programacao::get_infoPalestras(Input::get('abreviacao'))
			);

		return View::make('perfis.rh.listapresenca', $data);
	}

	/* Acesso a View Imprimir Lista de Presença */	
	public function get_imprimirlistapresenca($abreviacao) {
		$data = array(
				'participantes' => Presenca::lista_participantes($abreviacao),
				'palestra' => Programacao::get_infoPalestras($abreviacao)
			);
		
		return View::make('perfis.rh.Listaparticipantes', $data);
	}

	/* Acesso a View Voluntários */
	public function get_voluntarios() {
		$data = array(
				'voluntarios' => Voluntario::get_voluntarios()
			);
		return View::make('perfis.rh.voluntarios', $data);
	}

	/* Autorizar voluntário View Voluntários */
	public function post_voluntarios() {
		$cpfs = Input::get('cpfs');
		$voluntario = array();
		$realizacao = array();
		foreach ($cpfs as $u) {
			Voluntario::autoriza_voluntario($u);
			$new_date = array(
				'destinatario' => $u,
				'perfil' => 'usuario',
				'mensagem' => '3'
			);
			$voluntario[] = array(
				'cpf' => $u,
				'perfil' => 'Voluntario'
			);
			$realizacao[] = array(
				'quem' => Auth::user()->cpf,
				'oque' => 'Credenciou o usuário ' . $u . ' como Voluntário'
			);
		}
		Realizacao::inserir_realizacao($realizacao);
		Notificacao::inserir_notificacao($new_date);
		Perfil::inserir_perfil($voluntario);
		return Redirect::to_action('rh@voluntarios');
	}

	/* Acesso a View Usuários */
	public function get_usuarios() {
		$data = array(
				'registros' => Inscricao::busca_cpf(Input::get('cpf'))
			);
		return View::make('perfis.rh.usuarios', $data);
	}

	/* Busca por usuário por CPF na View Usuários */
	public function post_usuarios() {
		$data = array(
				'registros' => Inscricao::busca_cpf(Input::get('cpf'))
			);
		return View::make('perfis.rh.usuarios', $data);
	}

	/* Acesso a View Artigos */
	public function get_artigos() {
		$data = array(
				'artigos' => Artigo::get_all_artigos(),
				'msgm' => Session::get('revisorarstigo')
			);

		return View::make('perfis.rh.artigos', $data);
	}

	/* Acesso a View Vagas */
	public function get_vagas() {
		$palestras = Programacao::get_palestra();
		$array = array();
		foreach($palestras as $p) {
			$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
		}
		$topvagas = Programacao::get_topvagas();
		$data = array(
				'palestras' => $array,
				'topvagas' => $topvagas
			);		
		return View::make('perfis.rh.vagas', $data);
	}

	/* Visualização das vagas das palestras e minicursos na View Vagas */
	public function post_vagas() {
		$abreviacao = Input::get('abreviacao');
		$texto = null;
		if ($abreviacao == 'all') {
			$vagas = Programacao::get_topvagas();
		} else {
			$vagas = Programacao::get_vagas($abreviacao);
			$texto = "Vagas Restantes";
		}
		$data = array(
				'vagas' => $vagas,
				'texto' => $texto
			);
		return View::make('perfis.coordenador.controlevagas', $data);
	}

	/* Acesso a View Reinscricao */
	public function get_reinscricao() {
		$data = array(
				'reinscricoes' => Reinscricao::get_reinscricoes()
			);

		return View::make('perfis.rh.reinscricao', $data);
	}

	/* Busca de Reinscrição pelo Nome do Usuário na View Reinscricao */
	public function post_reinscricao() {
		$data = array(
				'reinscricoes' => Reinscricao::busca_reinscricoes(Input::get('nome'))
			);
		
		return View::make('perfis.rh.reinscricao', $data);
	}

	public function post_autorizareinscricao() {
		$dados = Input::get('reinscricao');
		$notificacao = array();
		$realizacao = array();
		foreach ($dados as $u) {
			Reinscricao::autoriza_reinscricao($u);
			Inscricao::excluir_inscricao($u);
			Presenca::excluir_presenca($u);
			 $notificacao[] = array(
				'destinatario' => $u,
				'perfil' => 'usuario',
				'mensagem' => '1'
			);
			$realizacao[] = array(
				'quem' => Auth::user()->cpf,
				'oque' => 'Autorizou a reinscrição do usuário ' . $u
			);
		}
		Notificacao::inserir_notificacao($notificacao);
		Realizacao::inserir_realizacao($realizacao);
		return Redirect::to_action('rh@reinscricao');
	}

	public function get_notificacao() {
		return View::make('perfis.rh.notificacao');
	}
}
?>