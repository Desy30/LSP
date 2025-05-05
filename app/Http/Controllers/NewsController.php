<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\EditorModel;
use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsModel::with(['category', 'author.user', 'editor.user'])->get(); // mengambil data (get juga bisa)

        return view('after-login.news.index', compact('news'));
    }

    public function create()
    {
        $categories = CategoryModel::all();
        $editors = EditorModel::with('user')->get();

        return view(
            'after-login.news.create',
            compact('categories', 'editors')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'editor_id' => 'required|exists:editor,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'image' => 'required|image',
            'content' => 'required',
        ]);
        $filename = time().'-'.$request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('news', $filename, 'public');

        $request->merge([
            'author_id' => auth()->user()->author->id,
            'slug' => Str::slug($request->title),
            'status' => 'draft',
        ]);

        NewsModel::create([
            'author_id' => $request->author_id,
            'editor_id' => $request->editor_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => $path,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('news');
    }

    public function edit($id)
    {
        $categories = CategoryModel::all();

        $editors = EditorModel::with('user')->get();

        $news = NewsModel::findOrFail(($id)); // menghasilkan satu data

        return view('after-login.news.edit', compact('categories', 'editors', 'news'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'editor_id' => 'required|exists:editor,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'image' => 'sometimes|image',
            'content' => 'required',
        ]);
        $news = NewsModel::findOrFail($id);

        $news->editor_id = $request->editor_id;
        $news->category_id = $request->category_id;
        $news->title = $request->title;
        $news->content = $request->content;

        if ($request->hasFile('image')) {
            $filename = time().'-'.$request->file('image')->getClientOriginalName(); // menyimpan file baru, agar tidak ada double

            $path = $request->file('image')->storeAs('news', $filename, 'public'); // memindahkan file news ke storge public

            if (Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            $news->image = $path;
        }

        $news->update(); // menjalankan

        return redirect()->route('news');
    }

    public function destroy($id)
    {
        $news = NewsModel::findOrFail($id);

        if (Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news');

    }
}
