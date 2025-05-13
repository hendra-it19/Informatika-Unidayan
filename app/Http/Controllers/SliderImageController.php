<?php

namespace App\Http\Controllers;

use App\Models\SliderImage;
use Illuminate\Http\Request;

class SliderImageController extends Controller
{

    private $pagination = 10;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SliderImage::latest('id')->paginate($this->pagination);
        $jumlahData = SliderImage::count();
        $paginate = $this->pagination < $jumlahData ? true : false;
        return view('dashboard.slider-beranda.index', [
            'judulHalaman' => 'Slider',
            'data' => $data,
            'pagination' => $paginate,
        ])->with('i', (request()->input('page', 1) - 1) * $this->pagination);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-admin.slider.create', [
            'judulHalaman' => 'Slider'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SliderImage $sliderImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SliderImage $sliderImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SliderImage $sliderImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SliderImage $sliderImage)
    {
        //
    }
}
