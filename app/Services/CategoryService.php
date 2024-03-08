<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Exception;

class CategoryService implements ServiceInterface
{   
    private $categoryModel;

    public function __construct(CategoryModel $categoryModel) {

        $this->categoryModel = $categoryModel;
    }

    public function index(){

        try {
            
            return $this->categoryModel::all();
            
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function create(array $data){}
    public function show($id){}
    public function update($id, array $data){}
    public function delete($id){}
}
