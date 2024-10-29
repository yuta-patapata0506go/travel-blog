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

    
        public function store(Request $request, $postId, $spotId)
        {
            $request->validate([
                'image.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            // dd($request->image);
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    // Convert the image to a Base64 string
                    $base64Image = 'data:image/' . $file->extension() . ';base64,' . base64_encode(file_get_contents($file));
                    $this->image->create([
                        'image_url' => $base64Image,
                        'post_id' => $postId,
                        'spot_id' => $spotId,
                        'user_id' => auth()->id(),
                        'caption' => 'new',
                        'status' => 'new',
                    ]);
                }
            }
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
