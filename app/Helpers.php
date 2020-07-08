<?php


use Illuminate\Http\Request;

function getPriceHelper($priceInDecimal) 
{

    //dd(session()->get('currency'));

    if(session()->get('currency') == null)
    {
        $priceInDecimal = floatval($priceInDecimal);
        return number_format($priceInDecimal , 2, ',', ' ') . ' DA';
    }
    
	else if(session()->get('currency') == "dzd")
	{
		$priceInDecimal = floatval($priceInDecimal);
    	return number_format($priceInDecimal , 2, ',', ' ') . ' DA';
	}
    else if (session()->get('currency') == "eur")
    {
        $priceInDecimal = floatval($priceInDecimal) * 0.0069;
        $priceInDecimal = $priceInDecimal;
        return number_format($priceInDecimal , 2, ',', ' ') . ' €';
    }
    else if (session()->get('currency') == "gbp")
    {
        $priceInDecimal = floatval($priceInDecimal) * 0.0062;
        $priceInDecimal = $priceInDecimal;
        return number_format($priceInDecimal , 2, ',', ' ') . ' £';
        
    }
    else if (session()->get('currency') == "usd")
    {
        $priceInDecimal = floatval($priceInDecimal) * 0.0077;
        $priceInDecimal = $priceInDecimal;
        return number_format($priceInDecimal , 2, ',', ' ') . ' $';
    }
}

function getPriceHelper_Pourcentage($priceInDecimal  , $pourcentage) 
{
    if(session()->get('currency') == null)
    {
        $priceInDecimal = (floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage/ 100));
        return number_format($priceInDecimal , 2, ',', ' ') . ' DA';        
    }
    
    else if(session()->get('currency') == "dzd")
    {
        $priceInDecimal = (floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100));
        return number_format($priceInDecimal , 2, ',', ' ') . ' DA';
    }
    else if (session()->get('currency') == "eur")
    {
        $priceInDecimal = ((floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100))) * 0.0069;
        return number_format($priceInDecimal , 2, ',', ' ') . ' €';
    }
    else if (session()->get('currency') == "gbp")
    {
        $priceInDecimal = ((floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100))) * 0.0062;
        return number_format($priceInDecimal , 2, ',', ' ') . ' £';
        
    }
    else if (session()->get('currency') == "usd")
    {
        $priceInDecimal = ((floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100))) * 0.0077;
        return number_format($priceInDecimal , 2, ',', ' ') . ' $';
    }
}


function getPriceHelper_days_Pourcentage($priceInDecimal , $days , $pourcentage) 
{
    if(session()->get('currency') == null)
    {
        $priceInDecimal = (floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * $days;
        return number_format($priceInDecimal , 2, ',', ' ') . ' DA';
    }
    
    else if(session()->get('currency') == "dzd")
    {
        $priceInDecimal = (floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * $days;        
        return number_format($priceInDecimal , 2, ',', ' ') . ' DA';
    }
    else if (session()->get('currency') == "eur")
    {

        $priceInDecimal = (((floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * $days)) * 0.0069;
        return number_format($priceInDecimal , 2, ',', ' ') . ' €';
    }
    else if (session()->get('currency') == "gbp")
    {
        $priceInDecimal = (((floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * $days)) * 0.0062;
        return number_format($priceInDecimal , 2, ',', ' ') . ' £';
        
    }
    else if (session()->get('currency') == "usd")
    {

        $priceInDecimal = (((floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * $days)) * 0.0077;
        return number_format($priceInDecimal , 2, ',', ' ') . ' $';
    }
}


function noStyleGetPrice_Pourcentage($priceInDecimal  , $pourcentage)
{
    if(session()->get('currency') == null)
    {
        $priceInDecimal = floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100);
        return $priceInDecimal;
    }
    
    else if(session()->get('currency') == "dzd")
    {
        $priceInDecimal = floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100);
        return number_format($priceInDecimal , 2, ',', ' ') . ' DA';
    }
    else if (session()->get('currency') == "eur")
    {
        $priceInDecimal = (floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * 0.0069;
        return number_format($priceInDecimal , 2, ',', ' ') . ' €';
    }
    else if (session()->get('currency') == "gbp")
    {
        $priceInDecimal = (floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * 0.0062;
        return number_format($priceInDecimal , 2, ',', ' ') . ' £';
        
    }
    else if (session()->get('currency') == "usd")
    {
        $priceInDecimal = (floatval($priceInDecimal) - (floatval($priceInDecimal) * $pourcentage / 100)) * 0.0077;
        return number_format($priceInDecimal , 2, ',', ' ') . ' $';
    }
}