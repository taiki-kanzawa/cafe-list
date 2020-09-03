<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cafe;
use App\Http\Requests\CafesRequest;

class CafesController extends Controller
{
    public function index()
    {
        $cafes = Cafe::orderBy('created_at', 'desc')->paginate(5);
        
        return view('welcome', [
            'cafes' => $cafes,
        ]);
    }
    
    public function create()
    {
        $cafe = new Cafe;
    
        return view('cafes.create', [
            'cafe' => $cafe,
        ]);
    }
    
    public function store(CafesRequest $request)
    {
        if (isset($request->image)) {
            $cafe = $request->user()->cafes()->create([
                'cafe_name' => $request->cafe_name,
                'address' => $request->address,
                'wifi' => $request->wifi,
                'electrical_outlet' => $request->electrical_outlet,
                'smoking_seat' => $request->smoking_seat,
                'parking' => $request->parking,
                'meal_menu' => $request->meal_menu,
            ]);
            
            $files = $request->file('image');
            
            foreach ($files as $file) {
                $image = $file->getClientOriginalName();
                $image_path = Storage::disk('s3')->putFileAs('/cafe_images', $file, $image, 'public');
                $cafe->cafe_images()->create([
                    'image' => $image_path,
                ]);
            }
        }
        
        return redirect('/');
    }
    
    public function show($id)
    {
        $cafe = Cafe::find($id);
        
        return view('cafes.show', [
            'cafe' => $cafe,
        ]);
    }
}
