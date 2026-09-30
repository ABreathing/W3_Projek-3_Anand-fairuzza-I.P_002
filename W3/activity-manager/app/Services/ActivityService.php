<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
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
        if (! empty($data['poster'])) {
            $data['poster_path'] = $data['poster']->store('posters', 'public');
        }
        unset($data['poster']);

        return Activity::create(array_merge($data, ['status' => 'draft']));
    }

    public function update(Activity $activity, array $data): Activity
    {
        unset($data['status']);

        if (! empty($data['poster'])) {
            $newPath = $data['poster']->store('posters', 'public');

            if ($activity->poster_path) {
                Storage::disk('public')->delete($activity->poster_path);
            }

            $data['poster_path'] = $newPath;
        }
        unset($data['poster']);

        $activity->update($data);

        return $activity;
    }

    public function publish(Activity $activity): Activity
    {
        $this->ensureValidTransition($activity->status, 'published');

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