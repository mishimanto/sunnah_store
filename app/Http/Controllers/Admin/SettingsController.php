<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Support\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function __construct(
        protected SettingRepositoryInterface $settings,
        protected MediaUploadService $uploads,
    ) {
    }

    public function edit(): View
    {
        return view('admin.settings.edit', ['settings' => $this->settings->get()]);
    }

    public function update(SettingRequest $request): RedirectResponse
    {
        $current = $this->settings->get();
        $data = $request->validated();
        $data['logo_path'] = $this->uploads->store($request->file('logo'), $current->logo_path, 'settings');

        $this->settings->update($data);

        return back()->with('success', 'Site settings updated.');
    }
}
