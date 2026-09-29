<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

protected $fillable = [
    'category_id', 'code', 'title', 'description',
    'location', 'start_at', 'end_at', 'capacity', 'status',
];

protected function casts(): array
{
    return ['start_at' => 'datetime', 'end_at' => 'datetime'];
}

public function category()
{
    return $this->belongsTo(Category::class);
}
}