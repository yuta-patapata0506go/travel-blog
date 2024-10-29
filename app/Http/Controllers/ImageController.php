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
    // public function store(Request $request, $postId)
    // {
    //     // バリデーション
    //     $request->validate([
    //         'image.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
    //     ]);

    //     // 複数画像の処理
    //     if ($request->hasfile('image')) {
    //         foreach ($request->file('image') as $file) {
    //             // 画像を保存
    //             $filename = time().'_'.$file->getClientOriginalName();
    //             $file->move(public_path('uploads'), $filename);

    //             // 画像情報を保存
    //             $this->image->create([
    //                 'post_id' => $postId,
    //                 'filename' => $filename,
    //             ]);
    //         }
    //     }
    // }

    public function store(Request $request, $postId)
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
                    'spot_id' => $request->spot,
                    'user_id' => auth()->id(),
                    'caption' => 'new',
                    'status' => 'new',
                ]);
            }
        }
    }
    
    
 

    public function destroy($id)
{
    $image = Image::findOrFail($id);
    $image->delete();

    return response()->json(['success' => true]);
}

}