<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    //
    protected $guarded = [];

    public function header()
    {
        return $this->belongsTo(SalesHeader::class,'sd_no','sh_no');
    }
}
