<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all()->map(function ($item) {
            $item->file_path = asset($item->file_path); // Convert to URL
            $item->file_extension = strtolower(pathinfo($item->file_path, PATHINFO_EXTENSION));
            $item->is_image = in_array($item->file_extension, ['jpg', 'jpeg', 'png', 'jfif', 'gif', 'webp']);
            $item->is_video = in_array($item->file_extension, ['mp4', 'mov', 'avi', 'webm']);
            return $item;
        });
    
        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
            'file' => 'required|file|max:20480',
            // 'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,mp3,wav,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',

        ]);
    
        // Store file in 'public/media' directory
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('media'), $fileName);
    
        Media::create([
            'title' => $request->title,
            'file_path' => 'media/' . $fileName,
        ]);
    
        return redirect()->route('media.index')->with('success', 'Media uploaded successfully!');
    }

    public function show($id)
    {
        $media = Media::findOrFail($id); // Fetch media or return 404
    
        $media->file_path = asset($media->file_path);
        $media->file_extension = strtolower(pathinfo($media->file_path, PATHINFO_EXTENSION));
        $media->is_image = in_array($media->file_extension, ['jpg', 'jpeg', 'png', 'jfif', 'gif', 'webp']);
        $media->is_video = in_array($media->file_extension, ['mp4', 'mov', 'avi', 'webm']);
    
        return view('admin.media.show', compact('media'));
    }

    public function edit($id)
    {
        $media = Media::findOrFail($id); // Fetch media or return 404
    
        $media->file_path = asset($media->file_path);
        $media->file_extension = strtolower(pathinfo($media->file_path, PATHINFO_EXTENSION));
        $media->is_image = in_array($media->file_extension, ['jpg', 'jpeg', 'png', 'jfif', 'gif', 'webp']);
        $media->is_video = in_array($media->file_extension, ['mp4', 'mov', 'avi', 'webm']);
    
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id); // Ensure ID matches and fetch the media
    
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,jfif,gif,webp,mp4,mov,avi,webm|max:80480',
        ]);
    
        if ($request->hasFile('file')) {
            // Delete old file if it exists
            if (File::exists(public_path($media->file_path))) {
                File::delete(public_path($media->file_path));
            }
    
            // Upload new file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('media'), $fileName);
            $media->file_path = 'media/' . $fileName;
        }
    
        $media->title = $request->title;
        $media->save();
    
        return redirect()->route('media.index')->with('success', 'Media updated successfully!');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id); // Ensure ID matches and fetch the media
    
        // Delete file from public folder
        if (File::exists(public_path($media->file_path))) {
            File::delete(public_path($media->file_path));
        }
    
        $media->delete(); // Delete the record from the database
    
        return redirect()->route('media.index')->with('success', 'Media deleted successfully!');
    }
}
