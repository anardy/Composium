<?php
class Revisor_Controller extends Base_Controller {
	public $restful = true;
	
	/* Acesso a View Revisor */
	public function get_revisor() {
		$data = array(
			'artigos' => Artigo::get_all_artigos(),
			'msgm' => Session::get('revisorartigo')
			);

		return View::make('perfis.revisor.home', $data);
	}

	public function post_aprovarartigo() {
		$cpf = Input::get('cpf');
		Artigo::aprovar_artigo($cpf);
		Artigo::revisar_artigo($cpf, Auth::user()->cpf, $data = date("Y/m/d H:i:s", time()));
		Session::put('revisorartigo', 'aprovado');
		
		$notificacao = array(
			'destinatario' => $cpf,
			'perfil' => 'usuario',
			'mensagem' => '2'
		);
		Notificacao::inserir_notificacao($notificacao);

		return Redirect::to_action('Revisor@Revisor');
	}

	public function get_ConArtigo($cpf) {
		if (isset($cpf)) {
			$results = Artigo::get_artigo($cpf);
			return View::make('perfis.revisor.conArtigo')->with('results', $results);
		}
	}

	public function get_notificacao() {
		return View::make('perfis.revisor.notificacao');
	}

	public function post_reprovarartigo() {
		$cpf = Input::get('cpf');
		Artigo::revisar_artigo($cpf, Auth::user()->cpf, $data = date("Y/m/d H:i:s"));
		Artigo::reprovar_artigo($cpf);
		Session::put('revisorartigo', 'reprovado');

		$notificacao = array(
			'destinatario' => $cpf,
			'perfil' => 'usuario',
			'mensagem' => '7'
		);
		Notificacao::inserir_notificacao($notificacao);
		
		return Redirect::to_action('Revisor@Revisor');
	}
}