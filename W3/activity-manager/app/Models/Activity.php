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

    public function scopeSearch($query, ?string $keyword)
    {
        return $query->when($keyword, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
            });
        });
    }

    public function scopeFilterCategory($query, ?string $categoryId)
    {
        return $query->when($categoryId, fn ($query, $id) => $query->where('category_id', $id));
    }

    public function scopeFilterStatus($query, ?string $status)
    {
        return $query->when($status, fn ($query, $status) => $query->where('status', $status));
    }

    public function scopeSortByDate($query, ?string $sort)
    {
        return $query->orderBy('start_at', $sort === 'oldest' ? 'asc' : 'desc');
    }
}