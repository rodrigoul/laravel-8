<?php

namespace App\Http\Controllers;

use App\Interfaces\ControllerInterface;
use Illuminate\Http\Request;
use App\Services\HomeService;

class HomeController extends Controller implements ControllerInterface
{   
    private $homeService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeService $homeService)
    {
        $this->middleware('auth');
        $this->homeService = $homeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $data = $this->homeService->index();
        //dd($categoryData->toArray());

        return view('home', [
            'itemsByCategory' => $data['itemsByCategory'],
            'mostBoughtItems' => $data['mostBoughtItems']
        ]);
    }

    public function create(Request $request){}

    public function show($id){}

    public function update($id, Request $request){}

    public function delete($id, Request $request){}
}
