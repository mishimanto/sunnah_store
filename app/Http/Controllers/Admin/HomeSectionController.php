<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeSectionRequest;
use App\Models\HomeSection;
use App\Repositories\Contracts\HomeSectionRepositoryInterface;
use App\Support\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeSectionController extends Controller
{
    public function __construct(
        protected HomeSectionRepositoryInterface $sections,
        protected MediaUploadService $uploads,
    ) {
    }

    public function index(): View
    {
        return view('admin.home-sections.index', [
            'sections' => $this->sections->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('admin.home-sections.form', ['section' => new HomeSection()]);
    }

    public function store(HomeSectionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), null, 'home-sections');
        $data['video_path'] = $this->uploads->store($request->file('video'), null, 'home-sections');

        $this->sections->create($data);

        return redirect()->route('admin.home-sections.index')->with('success', 'Home section created.');
    }

    public function edit(HomeSection $home_section): View
    {
        return view('admin.home-sections.form', ['section' => $home_section]);
    }

    public function update(HomeSectionRequest $request, HomeSection $home_section): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), $home_section->image_path, 'home-sections');
        $data['video_path'] = $this->uploads->store($request->file('video'), $home_section->video_path, 'home-sections');

        $this->sections->update($home_section, $data);

        return redirect()->route('admin.home-sections.index')->with('success', 'Home section updated.');
    }

    public function destroy(HomeSection $home_section): RedirectResponse
    {
        $this->sections->delete($home_section);

        return back()->with('success', 'Home section deleted.');
    }
}
