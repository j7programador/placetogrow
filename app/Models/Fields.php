<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    use HasFactory;

    protected $fillable = ['microsite_id', 'label', 'type', 'enabled', 'personal_info'];

    public function microsite()
    {
        return $this->belongsTo(Site::class);
    }
}
