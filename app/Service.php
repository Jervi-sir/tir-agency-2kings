<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
	public function getPrice()
	{
		$prix = $this->prix / 100;
		return number_format($prix , 2, ',', ' ') . ' DA';
	}
}
