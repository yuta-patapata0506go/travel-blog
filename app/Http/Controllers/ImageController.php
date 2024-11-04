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
   // ImageControllerの修正public function store(Request $request, $postId, $spotId)
   public function store(Request $request, $postId, $spotId)
   {
       // ログをメソッド内に記述する
       \Log::info("ImageController@store called for post ID: " . $postId);
       $request->validate([
           'image.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
       ]);
       if ($request->hasFile('image')) {
           try {
               foreach ($request->file('image') as $file) {
                   \Log::info("Saving image for post ID: " . $postId); // 画像保存処理に入っているか確認
                   // 画像をストレージに保存
                   $path = $file->store('images', 'public');
                   $this->image->create([
                       'image_url' => $path,
                       'post_id' => $postId,
                       'spot_id' => $spotId,
                       'user_id' => auth()->id(),
                       'caption' => 'new',
                       'status' => 'new',
                   ]);
               }
               return true;
           } catch (\Exception $e) {
               \Log::error('Failed to save the image: ' . $e->getMessage());
               return false;
           }
       }
       \Log::error("No image file found in request");
       return false;
   }
public function destroy($id)
{
    $image = Image::findOrFail($id);
    $image->delete();
    return response()->json(['success' => true], 200);
}
}