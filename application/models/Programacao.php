<?php
class Programacao extends Eloquent {
	public static function teste($data) {
		$users = DB::table('palestras')->where('dia', '=', $data)->order_by('hora')->order_by('abreviacao')->get(
				array('dia', 'hora', 'abreviacao', 'nome' , 'palestrante', 'local')
			);
		return $users;
	}
}