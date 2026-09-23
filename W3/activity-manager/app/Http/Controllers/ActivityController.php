<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    // status valid sesuai enum di migration, dipake buat validasi filter
    private const VALID_STATUSES = ['pending', 'in_progress', 'completed'];

    public function index(Request $request): View
    {
        $status = $request->query('status');
        $isValidStatus = in_array($status, self::VALID_STATUSES, true);

        $activities = Activity::query()
            ->when($isValidStatus, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // kalau nilai status di URL gak valid, dropdown balik nampilin "Semua"
        $status = $isValidStatus ? $status : null;

        return view('activities.index', compact('activities', 'status'));
    }

    public function create(): View
    {
        return view('activities.create');
    }

    public function store(StoreActivityRequest $request, ActivityService $service): RedirectResponse
    {
        $activity = $service->create($request->validated());

        return redirect()->route('activities.show', $activity)
            ->with('success', 'Aktivitas berhasil ditambahkan!');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        try {
            $service->update($activity, $request->validated());

            return redirect()->route('activities.show', $activity)
                ->with('success', 'Aktivitas berhasil diperbarui!');
        } catch (DomainException $e) {
            return back()->withInput()->withErrors(['status' => $e->getMessage()]);
        }
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Aktivitas berhasil dihapus!');
    }
}