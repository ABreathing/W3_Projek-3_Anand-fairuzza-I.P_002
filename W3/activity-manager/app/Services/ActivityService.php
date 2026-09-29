<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    private const TRANSITIONS = [
        'draft' => ['published'],
        'published' => ['completed'],
        'completed' => [],
    ];

    public function create(array $data): Activity
    {
        return Activity::create(array_merge($data, ['status' => 'draft']));
    }

    public function update(Activity $activity, array $data): Activity
    {
        // Form edit umum tidak boleh mengubah status (BR-06/BR-07).
        unset($data['status']);

        $activity->update($data);

        return $activity;
    }

    public function publish(Activity $activity): Activity
    {
        $this->ensureValidTransition($activity->status, 'published');

        // BR-05: field wajib harus lengkap dan valid sebelum publish.
        $missing = array_filter([
            'category_id' => $activity->category_id,
            'code' => $activity->code,
            'title' => $activity->title,
            'location' => $activity->location,
            'start_at' => $activity->start_at,
            'end_at' => $activity->end_at,
            'capacity' => $activity->capacity,
        ], fn ($value) => blank($value));

        if (! empty($missing)) {
            throw ValidationException::withMessages([
                'status' => 'Kegiatan belum lengkap (' . implode(', ', array_keys($missing)) . ') sehingga tidak dapat dipublikasikan.',
            ]);
        }

        $activity->update(['status' => 'published']);

        return $activity;
    }

    public function complete(Activity $activity): Activity
    {
        $this->ensureValidTransition($activity->status, 'completed');

        $activity->update(['status' => 'completed']);

        return $activity;
    }

    private function ensureValidTransition(string $current, string $next): void
    {
        $allowed = self::TRANSITIONS[$current] ?? [];

        if (! in_array($next, $allowed, true)) {
            throw ValidationException::withMessages([
                'status' => "Transisi status dari {$current} ke {$next} tidak diizinkan.",
            ]);
        }
    }
}