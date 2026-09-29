<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $activities = Activity::query()
            ->search($request->input('search'))
            ->filterCategory($request->input('category_id'))
            ->filterStatus($request->input('status'))
            ->sortByDate($request->input('sort'))
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', [
            'activities' => $activities,
            'categories' => Category::orderBy('name')->get(),
            'filters' => $request->only(['search', 'category_id', 'status', 'sort']),
        ]);
    }

    public function create(): View
    {
        return view('activities.create', [
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function store(StoreActivityRequest $request, ActivityService $service): RedirectResponse
    {
        $activity = $service->create($request->validated());

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        return view('activities.edit', [
            'activity' => $activity,
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        $service->update($activity, $request->validated());

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function publish(Activity $activity, ActivityService $service): RedirectResponse
    {
        try {
            $service->publish($activity);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return back()->withErrors($exception->errors());
        }

        return back()->with('success', 'Kegiatan berhasil dipublikasikan.');
    }

    public function complete(Activity $activity, ActivityService $service): RedirectResponse
    {
        try {
            $service->complete($activity);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return back()->withErrors($exception->errors());
        }

        return back()->with('success', 'Kegiatan ditandai selesai.');
    }

    private function categoryOptions(): Collection
    {
        return Category::orderBy('name')->get();
    }
}