<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Activity;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    public function store(
        StoreRegistrationRequest $request,
        Activity $activity,
        RegistrationService $service
    ): RedirectResponse {
        try {
            $service->register($activity, $request->validated());
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->errors())->withInput();
        }

        return back()->with('success', 'Pendaftaran berhasil.');
    }
}