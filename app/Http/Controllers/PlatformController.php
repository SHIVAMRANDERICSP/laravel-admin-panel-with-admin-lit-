<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index(Request $request)
    {
        $data = Platform::get();
        return view('admin.platform.index', compact('data'));
    }
    public function add(Request $request)
    {
        return view('admin.platform.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required',
            'status' => "0"
        ]);
        Platform::create($request->all());
        return redirect()->route('platform')
            ->with('success', 'Post created successfully.');
    }

    public function edit($id, Request $request)
    {
        $data = Platform::find($id);
        return view('admin.platform.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required',
            'status' => "0"

        ]);
        $post = Platform::find($id);
        $post->update($request->all());
        return redirect()->route('platform')
            ->with('success', 'Url updated successfully.');
    }

    public function delete($id, Request $request)
    {
        $data = Platform::find($id);
        $data->delete();
        return redirect()->route('platform')
            ->with('success', 'Url updated successfully.');
    }
}
