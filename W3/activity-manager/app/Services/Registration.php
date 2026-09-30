<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function register(Activity $activity, array $data): Registration
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'status' => 'Pendaftaran hanya dibuka untuk kegiatan yang sudah dipublikasikan.',
            ]);
        }

        if ($activity->start_at->isPast()) {
            throw ValidationException::withMessages([
                'status' => 'Pendaftaran ditolak karena kegiatan sudah dimulai.',
            ]);
        }

        $alreadyRegistered = $activity->registrations()
            ->where('email', $data['email'])
            ->exists();

        if ($alreadyRegistered) {
            throw ValidationException::withMessages([
                'email' => 'Email ini sudah terdaftar pada kegiatan ini.',
            ]);
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw ValidationException::withMessages([
                'capacity' => 'Kapasitas kegiatan sudah penuh.',
            ]);
        }

        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email' => $data['email'],
                'registered_at' => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }
}