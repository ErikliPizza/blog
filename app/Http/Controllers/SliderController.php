<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Image;
class SliderController extends Controller
{
    public function create()
    {
        return view('manage-sliders', [
            'sliders' => Slider::All()
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'image' => 'required|image',
            'link' => ''
        ]);

        $image = request()->file('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/storage/sliders');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->fit(1920, 720, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->resizeCanvas(1920, 720)
            ->save($destinationPath.'/'.$input['image']);

        $attributes['image'] = 'sliders/'.$input['image'];

        Slider::create($attributes);

        return back();
    }

    public function update(Slider $slider)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'image' => 'image',
            'link' => ''
        ]);

        if(isset($attributes['image'])) {
            $imagePath = public_path('storage/'.$slider->image); //storage/sliders/filename
            if(File::exists($imagePath)){
                unlink($imagePath);
            }
            $image = request()->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/storage/sliders');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->fit(1920, 720, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->resizeCanvas(1920, 720)
                ->save($destinationPath.'/'.$input['image']);


            $attributes['image'] = 'sliders/'.$input['image'];
        }

        $slider->update($attributes);

        return back();
    }

    public function destroy(Slider $slider)
    {
        $imagePath = public_path('storage/'.$slider->image); //storage/sliders/filename
        if(File::exists($imagePath)){
            unlink($imagePath);
        }
        $slider->delete();
    }


}
