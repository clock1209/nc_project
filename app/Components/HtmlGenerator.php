<?php 

namespace App\Components;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;


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

	public function radios(){

		$espera = "";
		$resuelto = "";
		$cancelado = "";
		if (Input::old('radio')=='En espera del cliente') {
			$espera = 'checked=true;';
		}elseif (Input::old('radio')=='Resuelto') {
			$resuelto = 'checked=true;';
		}elseif (Input::old('radio')=='Cancelado') {
			$cancelado = 'checked=true;';
		}

		$html =
		'<label class="checkbox-inline btn btn-default"><input type="radio" name="radio" value="En espera del cliente" checked="true" '.$espera.'> En espera del cliente</label>
		<label class="checkbox-inline btn btn-default"><input type="radio" name="radio" value="Resuelto" '.$resuelto.'> Resuelto</label>
		<label class="checkbox-inline btn btn-default"><input type="radio" name="radio" value="Cancelado" '.$cancelado.'> Cancelado</label>';

		return $html;
	}

	public function rbReport(){

		$range = "";
		$month = "";
		if (Input::old('rbReport')=='Rango de fechas') {
			$range = 'checked=true;';
		}elseif (Input::old('rbReport')=='Mes') {
			$month = 'checked=true;';
		}
		$html =
		'<label class="checkbox-inline"><input type="radio" name="rbReport" value="Rango de fechas" checked="true" '.$range.' id="rbRange"> Rango de fechas</label>
		<label class="checkbox-inline"><input type="radio" name="rbReport" value="Mes" '.$month.' id="rbMonth"> Mes</label>';

		return $html;
	}

	// public function rbSelected()
	// {
	// 	$rbSelected = Input::get('rbReport');
	// 	$html = '';

 //        switch ($rbSelected) {
 //            case 'Rango de fechas':
 //                $html =
 //                '<div class="col-sm-4 col-md-offset-2">
 //                    <input class="form-control datepicker" name="date" type="date" value="date">
 //                </div>
 //                <div class="col-sm-1 text-center">
 //                    <span>ó</span>
 //                </div>
 //                <div class="col-sm-4">
 //                    <input class="form-control datepicker" name="date" type="date" value="date">
 //                </div>';

 //                return $html;

 //                break;

 //            case 'Mes':
 //                $html =
 //                '<div class="col-sm-4 col-md-offset-2"><select class="form-control" id="months" name="months"></select></div>';

 //                return $html;

 //                break;
            
 //            default:
 //                # code...
 //                break;
 //         }
	// }

	public function alert_ajax($alertName)
	{
		$html = 
		'<div id="msj-authorized" class="alert alert-success alert-dismissible" role="alert" style="display: none">
		<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
			<strong class="msg-text">'.$alertName.'</strong>
		</div>';

		return $html;						
	}

}