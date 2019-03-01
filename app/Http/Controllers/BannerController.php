<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\FormRequestBanner;
use App\Repositories\ImageRepository;

class BannerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Banner::paginate('9');
        return view('banners.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequestBanner $request, ImageRepository $repo)
    {
        $dataForm = $request->except('img');
        $banner = Banner::create($dataForm);
        if ($request->hasFile('img')) {
            $banner->url = $repo->saveImage($request->img, $banner->id, 'banners', 250);
            $banner->save();
        }
        return redirect()->route('banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormRequestBanner $request, $id, ImageRepository $repo)
    {
        $banner = Banner::find($id);
        $banner->update($request->all());
        if ($request->hasFile('img')) {
            $this->deleteImage($banner->url);
            $banner->url = $repo->saveImage($request->img, $banner->id, 'banners', 1000);
            $banner->save();
        }
        if (($request->apagaImg == "on") && (!$request->hasFile('img'))) {
            $this->deleteImage($banner->image);
            $banner->url = "";
            $banner->save();
        }
        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $banner = Banner::find($request->id);
        $this->deleteImage($banner->url);
        $banner->delete();
        return redirect()->route('banners.index');
    }

    /**
     * Filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filtrar(Request $request)
    {
        $dataForm = array_filter($request->all());
        $data = Banner::where(function ($query) use ($dataForm) {
            if (array_key_exists('name', $dataForm)) {
                $filtro = $dataForm['name'];
                $query->where('name', "like", "%{$filtro}%");
            }
            if (array_key_exists('description', $dataForm)) {
                $filtro = $dataForm['description'];
                $query->where('description', 'like', "%{$filtro}%");
            }
            if (array_key_exists('imagem', $dataForm)) {
                if($dataForm['imagem']=="1"){
                    $query->where('url', "=", "");
                }else{
                    $query->where('url', "!=", "");
                }
            }
        })
            ->paginate(9);
        return view('banners.index', compact('data'));
    }

    /**
     * Remove image from storage.
     *
     * @param  string  $imagem
     * @return
     */
    private function deleteImage($imagem)
    {
        $caminhoImagem = str_replace('http://' . $_SERVER['HTTP_HOST'] . '/', "", $imagem);
        if (($caminhoImagem != "") && ($caminhoImagem != "images/banners/placeholder300x300.jpg")) {
            unlink($caminhoImagem);
        }
    }
}
