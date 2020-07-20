<?php

namespace App\Services;

use App\Entities\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function create($data) {
        DB::beginTransaction();
        try {
            $category = Category::create([
                'name' => $data['name'],
                'title' => $data['title'],
                'meta_description' => $data['meta_description'],
                'created_at' => time(),
            ]);

            DB::commit();
            return $category;

        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function update($data) {
        DB::beginTransaction();
        try {

            $category = Category::where('id', $data['id'])->update([
                'name' => $data['name'],
                'title' => $data['title'],
                'meta_description' => $data['meta_description'],
            ]);

            DB::commit();
            return $category;

        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
