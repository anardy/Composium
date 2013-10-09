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
		Artigo::aprovar_artigo(Input::get('cpf'));
		Session::put('revisorartigo', 'aprovado');
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
}