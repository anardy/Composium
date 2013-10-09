<?php
class Minharea_Controller extends Base_Controller {
	public $restful = true;
	
	public function get_minharea() {
		$cpf = Auth::user()->cpf;

		$data = array(
				'user_pagou' => Inscricao::user_pagou($cpf),
				'horario' => Programacao::gerar_horario_user($cpf)
			);

		return View::make('account.area', $data);
	}

	/* Acesso a View Boleto */
	public function get_boleto() {
		$cpf = Auth::user()->cpf;
		$data = array(
				'result' => Cadastro::get_nome($cpf),
				'total' => Inscricao::get_valor($cpf)
			);

		return View::make('inscricao.boleto', $data);
	}

	/* Acesso a View Reinscrição */
	public function get_reinscricao() {
		$data = array(
				'reinscricao' => Reinscricao::get_reinscricao_user(Auth::user()->cpf)
			);
		
		return View::make('account.reinscricao', $data);
	}

	public function post_reinscricao() {
		Reinscricao::inserir_reinscricao(Auth::user()->cpf);
		$notificacao = array(
			'perfil' => 'rh',
			'mensagem' => '8'
		);
		Notificacao::inserir_notificacao($notificacao);
		return "<h4>Sua Reinscrição foi enviada com sucesso!!</h4>
        	<p>Assim que sua Reinscrição for autorizada você receberá um e-mail para realizar a Inscrição novamente</p>
        	<p>Dúvidas entre em contato: composium@unifei.edu.com.br</p>
        	<p>Obrigado,</p>
        	<p>Equipe de Organização do III Composium</p>";
	}

	/* Acesso a View Meus Dados */
	public function get_meusdados() {
		$data = array(
				'results' => Cadastro::get_dados(Auth::user()->cpf)
			);
		return View::make('account.dados', $data);
	}

	public function post_AltDados() {
		$new_date = array(
				'firstnome' => Input::get('firstnome'),
				'lastnome' => Input::get('lastnome'),
				'matricula' => Input::get('matricula'),
				'email' => Input::get('email'),
				'instituicao' => Input::get('instituicao'),
				'curso' => Input::get('curso'),
				'ano' => Input::get('ano'),
				'periodo' => Input::get('periodo')
				);

		$regras = array(
			'firstnome' => 'required',
			'lastnome' => 'required',
			'email' => 'required',
			'ano' => 'required',
			'periodo' => 'required'
			);

		$v = Validator::make($new_date, $regras);

		if ($v->fails()) {
			return Redirect::to_action('minharea@meusdados')->with_errors($v)->with_input();
		}

		Cadastro::atualizar_dados(Auth::user()->cpf, $new_date);

		return Redirect::to_action('minharea@meusdados');
	}

	/* Acesso a View Artigo */
	public function get_artigo() {
		$data = array(
				'msgm' => Session::get('artigo')
			);
		return View::make('account.artigo', $data);
	}

	public function post_artigo() {
		$cpf = Auth::user()->cpf;
		$titulo = Input::get('titulo');
		$autores = Input::get('autores');
		$resumo = Input::get('resumo');
		$palavrachave = Input::get('palavrachave');
		$artigo = Input::get('artigo');

		$new_date = array(
			'titulo' => $titulo,
			'autores' => $autores,
			'resumo' => $resumo,
			'palavrachave' => $palavrachave,
			'artigo' => $artigo
		);

		$regras = array(
			'titulo' => 'required',
			'autores' => 'required',
			'resumo' => 'required',
			'palavrachave' => 'required',
			'artigo' => 'mimes:pdf'
			);

		$v = Validator::make($new_date, $regras);

		if ($v->fails()) {
			return Redirect::to_action('minharea@artigo')->with_errors($v)->with_input();
		}

		$filename = $cpf.'.pdf';
		Artigo::inserir_artigo($cpf, $titulo, $autores, $resumo, $palavrachave, $filename);
	    Input::upload('artigo', 'public/artigos', $filename);
	    Session::put('artigo', 'enviado');
		return Redirect::to_action('minharea@artigo');
	}

	/* Acesso a View Presença */
	public function get_presenca() {
		$cpf = Auth::user()->cpf;
		$nrouser_presencauser = Presenca::nrouser_presencauser($cpf);
	    $nrototal_user = Presenca::nrototal_user($cpf);

	    if ($nrototal_user > 0) {
	    	$media_user = ($nrouser_presencauser * 100)/$nrototal_user;
	    } else {
	    	$media_user = 0;
	    }

	    $data = array(
				'controle_presenca' => Presenca::buscar_presenca($cpf),
				'media_user' => $media_user
	    	);

		return View::make('account.presenca', $data);
	}

	/* Acesso a View Certifcado */
	public function get_certificado() {
		$cpf = Auth::user()->cpf;
		$data = array(
				'certificados' => Presenca::get_certificados($cpf),
				'total_presenca_user' => Presenca::nrouser_presencauser($cpf),
				'total_user' => Presenca::nrototal_user($cpf)
			);
		return View::make('account.certificados', $data);
	}

	/* Acesso a View Voluntário */
	public function get_voluntario() {
		return View::make('account.voluntario');
	}

	public function post_voluntario() {
		$new_date = array(
			'cpf' => Auth::user()->cpf,
			'primeiraopcao' => Input::get('primeiraopcao'),
			'segundaopcao' => Input::get('segundaopcao'),
			'terceiraopcao' => Input::get('terceiraopcao'),
			'status' => '0'
		);

		Voluntario::inserir_voluntario($new_date);
		Reinscricao::inserir_reinscricao(Auth::user()->cpf);
		$notificacao = array(
				'perfil' => 'rh',
				'mensagem' => '9'
			);
		Notificacao::inserir_notificacao($notificacao);
		return Redirect::to_action('minharea@voluntario');
	}

	public function get_notificacao() {
		return View::make('account.notificacao');
	}
}
?>