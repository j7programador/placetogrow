<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    use HasFactory;

    protected $fillable = ['microsite_id', 'label', 'type', 'enabled'];

    public function site()
    {
        return $this->belongsTo(MicroSite::class);
    }
}
