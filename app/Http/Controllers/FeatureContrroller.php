<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureContrroller extends Controller
{
    public function index()
    {
        // $statuses = (object) [];
        // $statuses->requested = Feature::where('status', 'requested')->count();
        // $statuses->planned = Feature::where('status', 'planned')->count();
        // $statuses->completed = Feature::where('status', 'completed')->count();

        $statuses = Feature::toBase()
            ->selectRaw("count(case when status = 'Requested' then 1 end) as requested")
            ->selectRaw("count(case when status = 'Planned' then 1 end) as planned")
            ->selectRaw("count(case when status = 'Completed' then 1 end) as completed")->first();

        $features = Feature::query()
            ->withCount('comments')
            ->paginate();

        return view('features', [
            'statuses' => $statuses,
            'features' => $features
        ]);
    }

    public function show(Feature $feature)
    {
        $feature->load('comments.user');
        $feature->comments->each->setRelation('feature', $feature);

        return view('feature', ['feature' => $feature]);
    }
}
