<?php
class Coordenador_Controller extends Base_Controller {
	public $restful = true;

	public function get_coordenador() {
		$data = array(
				'c_voluntarios' => Voluntario::count_voluntarios(),
				'c_artigos' => Artigo::count_artigos(),
				'c_users' => Cadastro::count_users(),
				'c_pagantes' => Inscricao::count_pagantes(),
				'ultimos_users' => Cadastro::ultimos_users(),
				'ultimas_realizacoes' => Realizacao::ultimas_realizacoes_all()
			);
		return View::make('perfis.coordenador.home', $data);
	}

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
		return View::make('perfis.coordenador.vagas', $data);
	}

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

	public function get_inscricoes() {
		$data = array(
				'porcurso' => Cadastro::grafico_porcuros(),
				'porinstuicao' => Cadastro::grafico_porinstituicao(),
				'maisprocurados' => Presenca::get_maisprocurados()
			);
		return View::make('perfis.coordenador.inscricoes', $data);
	}

	public function get_presencas() {
		$total = Presenca::get_total();
		$mediaPresentes = (Presenca::get_all_presentes()/$total)*100;
		$mediaAusentes = (Presenca::get_all_ausentes()/$total)*100;
		if ($mediaPresentes > $mediaAusentes) {
			$texto = "It's Good!!";
		} else {
			$texto = "It's Bad!";
		}
		$palestras = Programacao::get_palestra();
		$array = array();
		foreach($palestras as $p) {
			$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
		}
		$data = array(
				'palestras' => $array,
				'dados' => json_encode(Presenca::get_graph()),
				'mediaPresentes' => round($mediaPresentes),
				'mediaAusentes' => round($mediaAusentes),
				'texto' => $texto
			);
		return View::make('perfis.coordenador.presencas', $data);
	}

	public function post_presencas() {
		$abreviacao = Input::get('abreviacao');
		if ($abreviacao == 'all') {
			$data = array(
					'dados' => Presenca::get_bestpresenca()
				);
			return View::make('perfis.coordenador.controlepresencatop10', $data);
		} else {
			$presentess = Presenca::get_presentes($abreviacao);
			$total = Presenca::nrototal_abreviacao($abreviacao);
			$data = array(
					'presentes' => $presentess,
					'ausentes' => Presenca::get_ausentes($abreviacao),
					'total' => Presenca::nrototal_abreviacao($abreviacao),
					'percentual' => round(($presentess * 100)/$total)
				);
			return View::make('perfis.coordenador.controlepresenca', $data);
		}
	}

	public function get_contabilidade() {
		$data = array(
				'emcaixa' => Inscricao::get_emcaixa(),
				'areceber' => Inscricao::get_areceber()
			);
		return View::make('perfis.coordenador.contabilidade', $data);
	}

	public function get_orcamento() {
		return View::make('perfis.coordenador.orcamento');
	}

	public function get_artigos() {
		$data = array(
				'artigos' => Artigo::get_all_artigos(),
				'msgm' => Session::get('revisorartigo')
			);
		return View::make('perfis.coordenador.artigos', $data);
	}

	public function get_notificacao() {
		return View::make('perfis.coordenador.notificacao');
	}
}
?>