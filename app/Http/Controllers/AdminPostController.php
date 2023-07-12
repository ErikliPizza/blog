<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Image;
class AdminPostController extends Controller
{
    public function create()
    {
        return view('manage-posts', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }
    public function edit(Post $post)
    {
        return view('components.edit-post', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if(isset($attributes['thumbnail'])) {

            $imagePath = public_path('storage/'.$post->thumbnail); //storage/thumbnail/filename
            if(File::exists($imagePath)){
                unlink($imagePath);
            }

            $image = request()->file('thumbnail');
            $input['thumbnail'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/thumbnails');

            $imgFile = Image::make($image->getRealPath());
            $imgFile->fit(720, 720, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->resizeCanvas(700, 480)
                ->save($destinationPath.'/'.$input['thumbnail']);


            $attributes['thumbnail'] = 'thumbnails/'.$input['thumbnail'];
        }

        $post->update($attributes);

        return back();
    }

    public function store()
    {
        $post = new Post();

        $attributes = $this->validatePost($post);
        $attributes['user_id'] = auth()->id();

        $image = request()->file('thumbnail');
        $input['thumbnail'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/storage/thumbnails');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->fit(720, 720, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->resizeCanvas(700, 480)
            ->save($destinationPath.'/'.$input['thumbnail']);


        $attributes['thumbnail'] = 'thumbnails/'.$input['thumbnail'];

        Post::create($attributes);

        return redirect('/');
    }
    public function destroy(Post $post)
    {
        $post->delete();

        return back();
    }
    protected function validatePost(Post $post = null): array
    {
        // store request
        // update request
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail' => $post->exists ? 'image' : 'required|image',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);
    }
}
