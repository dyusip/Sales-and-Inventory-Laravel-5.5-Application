<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SalesHeader extends Model
{
    //
    protected $guarded = [];

    public function getDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
    }
    public function detail()
    {
        return $this->hasMany(SalesDetail::class,'sd_no','sh_no');
    }
}
