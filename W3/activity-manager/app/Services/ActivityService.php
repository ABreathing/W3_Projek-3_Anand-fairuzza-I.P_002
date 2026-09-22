<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;

class ActivityService
{
    public function create(array $data): Activity
    {
        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        if (isset($data['status'])) {
            $this->ensureValidTransition($activity->status, $data['status']);
        }

        $activity->update($data);

        return $activity;
    }

    private function ensureValidTransition(
        string $current,
        string $next
    ): void {
        if ($current === $next) {
            return;
        }

        $allowedTransitions = [
            'Planned' => ['Ongoing'],
            'Ongoing' => ['Done'],
            'Done' => [],
            'pending' => ['in_progress'],
            'in_progress' => ['completed'],
            'completed' => [],
        ];

        if (! isset($allowedTransitions[$current]) || ! in_array($next, $allowedTransitions[$current], true)) {
            throw new DomainException("Transisi status dari {$current} ke {$next} tidak diizinkan.");
        }
    }
}
