<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use App\Repositories\Contracts\PageRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(protected PageRepositoryInterface $pages)
    {
    }

    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => $this->pages->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.form', ['page' => new Page()]);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        $this->pages->create($request->validated());

        return redirect()->route('admin.pages.index')->with('success', 'Page created.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.form', ['page' => $page]);
    }

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $this->pages->update($page, $request->validated());

        return redirect()->route('admin.pages.index')->with('success', 'Page updated.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $this->pages->delete($page);

        return back()->with('success', 'Page deleted.');
    }
}
