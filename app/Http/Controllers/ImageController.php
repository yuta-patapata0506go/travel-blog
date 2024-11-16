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
            'image.*' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);
        if ($request->hasFile('image')) {
            try {
                foreach ($request->file('image') as $file) {
                    // 画像をストレージに保存
                    $path = $file->store('images', 'public'); // imagesフォルダに保存
                    // データベースに保存
                    $this->image->create([
                        'image_url' => $path,
                        'post_id' => $postId,
                        'spot_id' => $spotId,
                        'user_id' => auth()->id(),
                        'caption' => 'new',
                        'status' => 'new',
                    ]);
                }
                return redirect()->back()->with('success', 'Images saved successfully.');
            } catch (\Exception $e) {
                \Log::error('Failed to save the image: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Failed to save the image: ' . $e->getMessage()]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Image file not selected.']);
        }
    }
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
    
        return response()->json(['success' => 'Image deleted successfully.']);
    }
    
}