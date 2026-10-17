<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 1) {
            // Jika admin, tampilkan semua artikel
            $articles = Article::with('Category')->latest()->get();
        } else {
            // Jika bukan admin, tampilkan hanya artikel yang dibuat oleh user tersebut
            $articles = Article::with('Category')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('back.article.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.article.create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        // Validasi data
        $data = $request->validated();

        // Proses upload file img
        $file = $request->file('img'); // Dapatkan file
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension(); // Generate nama unik
        $file->storeAs('public/back', $fileName); // Simpan ke folder public/back

        // $data['user_id'] = auth()->user()->id();
        $data['user_id'] = Auth::user()->id;
        $data['img'] = $fileName; // Simpan nama file ke data
        $data['slug'] = Str::slug($data['title']);

        // Simpan data ke database
        Article::create($data);

        // Redirect dengan pesan sukses
        return redirect(url('article'))->with('success', 'Data article has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('back.article.show', [
            'article' => Article::with(['User', 'Category'])->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.article.update', [
            'article' => Article::find($id),
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        $article = Article::findOrFail($id);

        // Jika role admin (role == 1), hanya update status
        if (Auth::user()->role == 1) {
            $request->validate([
                'status' => 'required|in:0,1,2,3',
            ]);

            // Update hanya status
            $article->update([
                'status' => $request->status,
            ]);

            return redirect(url('article'))->with('success', 'Article status has been updated');
        }

        // Jika user (role != 1), proses update artikel lengkap
        $data = $request->validated();

        // Ambil gambar lama
        $oldImage = $request->input('oldImg');

        // Proses upload gambar jika ada file baru
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke folder public/back
            $file->storeAs('public/back', $fileName);

            // Hapus gambar lama jika ada
            if (!empty($oldImage) && Storage::exists('public/back/' . $oldImage)) {
                Storage::delete('public/back/' . $oldImage);
            }

            // Update data dengan nama file baru
            $data['img'] = $fileName;
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $data['img'] = $oldImage;
        }

        // Generate slug dari title
        $data['slug'] = Str::slug($data['title']);

        // Pastikan user_id tidak diubah
        unset($data['user_id']);

        // Update artikel dengan data baru
        $article->update($data);

        // Redirect dengan pesan sukses
        return redirect(url('article'))->with('success', 'Article has been updated');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Article::find($id);
        Storage::delete('public/back/' . $data->img);
        $data->delete();
        return response()->json([
            'message' => 'Data article has been deleted'
        ]);
    }
}
