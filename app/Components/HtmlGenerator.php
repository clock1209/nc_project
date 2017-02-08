<?php 

namespace App\Components;

use Illuminate\Support\Facades\URL;

class HtmlGenerator
{
	public function link($url = null, $name = null, $class = null)
	{
		$url = URL::to($url, [], null);
		//si no tenemos el &name pero tenemos $url
		if (isset($url) && is_null($name)) {
            $name = $url;
        }
        return view('HtmlGenerator.link', compact('name', 'url', 'class'));
	}

	public function radioGroup($var)
	{
		$res = null;
		switch ($var) {
			case 'Cancelado':
				$res = 
				'<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="En espera del cliente"> En espera del cliente</label>'
				. '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="Resuelto"> Resuelto</label>'
				. '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="Cancelado"  checked="true"> Cancelado</label>';
			break;
			case 'En espera del cliente':
			$res =
				 '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="En espera del cliente" checked="true"> En espera del cliente</label>'
				. '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="Resuelto"> Resuelto</label>'
				. '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="Cancelado"> Cancelado</label>';
			break;
			case 'Resuelto':
			$res =
				 '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="En espera del cliente"> En espera del cliente</label>'
				. '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="Resuelto" checked="true"> Resuelto</label>'
				. '<label class="checkbox-inline btn btn-default"><input type="radio" name="status" value="Cancelado"> Cancelado</label>';
			break;
			default:
               
			break;
		}

		return $res;
	}
}