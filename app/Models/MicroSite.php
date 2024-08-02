<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MicroSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'document_type',
        'document',
        'category_id',
        'type_microsite',
        'enabled_at',
        'img_url',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function fields()
    {
        return $this->hasMany(Fields::class);
    }
}
