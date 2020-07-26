<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use App\Entities\Home;
use App\Entities\Media;
use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $homes = Home::all()->slice(0, 4);

        $entityMedia = DB::table('entity_media')->where('entity_type', 1);
        $homeId = $entityMedia->pluck('entity_id')->toArray();
        $allMedia = Media::whereIn('id', $entityMedia->pluck('media_id')->toArray())->get();

        return view('home', compact(['homes', 'allMedia', 'homeId', 'entityMedia']));
    }
}
