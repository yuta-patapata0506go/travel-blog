<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    // 画像のアップロード
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 画像のバリデーション
            'caption' => 'nullable|string|max:255',
            'status' => 'required|string|in:published,draft',
            'post_id' => 'nullable|exists:posts,id', // 投稿に関連付け
            'spot_id' => 'nullable|exists:spots,id', // スポットに関連付け
        ]);

        // 画像を保存する
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('images', 'public'); // ストレージに保存
        }

        // 新しい画像レコードを作成
        $this->image->image_url = $imagePath; // 保存した画像のパスを格納
        $this->image->caption = $request->input('caption');
        $this->image->status = $request->input('status');
        $this->image->user_id = auth()->id(); // 現在のユーザーを設定
        $this->image->post_id = $request->input('post_id'); // 投稿に関連付け
        $this->image->spot_id = $request->input('spot_id'); // スポットに関連付け
        $this->image->save();

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    // 画像の一覧表示
    public function index()
    {
        $images = $this->image->with('user', 'post', 'spot')->paginate(10);

        return view('images.index', compact('images'));
    }

    // 画像の詳細表示
    public function show($id)
    {
        $image = $this->image->with('user', 'post', 'spot')->findOrFail($id);

        return view('images.show', compact('image'));
    }

    // 画像の編集
    public function edit($id)
    {
        $image = $this->image->findOrFail($id);

        if ($image->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        return view('images.edit', compact('image'));
    }

    // 画像の更新
    public function update(Request $request, $id)
    {
        $image = $this->image->findOrFail($id);

        if ($image->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'caption' => 'nullable|string|max:255',
            'status' => 'required|string|in:published,draft',
        ]);

        $image->caption = $request->input('caption');
        $image->status = $request->input('status');
        $image->save();

        return redirect()->back()->with('success', 'Image updated successfully.');
    }

    // 画像の削除
    public function destroy($id)
    {
        
        $image = $this->image->findOrFail($id);

        if ($image->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // 画像を削除
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }


}
