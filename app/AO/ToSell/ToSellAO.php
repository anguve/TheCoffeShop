<?php

namespace App\AO\ToSell;
use App\Models\ToSell\ToSell;
use Illuminate\Support\Facades\DB;
class ToSellAO{

    public static function getToSells()
    {
        return ToSell::all();
    }

    public static function getSingleToSells($id)
    {
        return ToSell::findOrFail($id);
    }
    public static function createToSells($dataToSells)
    {
        return ToSell::create($dataToSells);
    }

    
}