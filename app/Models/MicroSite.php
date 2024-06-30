<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'document_type',
        'document',
        'category',
        'type_microsite',
        'enabled_at',
        'img_url',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
