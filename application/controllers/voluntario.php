<?php
class Voluntario_Controller extends Base_Controller {
	public $restful = true;

	/* Acesso a View Voluntário */
	public function get_voluntario() {
		return View::make('perfis.voluntario.voluntario');
	}

	public function get_notificacao() {
		return View::make('perfis.voluntario.notificacao');
	}
}
?>