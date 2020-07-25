<?php

namespace App\Services;

use App\Entities\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return Category::create([
            'name' => $data['name'],
            'title' => $data['title'],
            'meta_description' => $data['meta_description'],
            'created_at' => time(),
        ]);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->categoryRepository->update([
            'name' => $data['name'],
            'title' => $data['title'],
            'meta_description' => $data['meta_description'],
        ], $id);
    }
}
