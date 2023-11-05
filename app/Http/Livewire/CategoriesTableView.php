<?php

namespace App\Http\Livewire;

use App\Models\Category;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class CategoriesTableView extends TableView
{
    protected $paginate = 10;
    public $searchBy = ['id', 'name', 'description', 'color'];

    protected function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return Category::query();
    }

    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('id'),
            Header::title('Name')->sortBy('name'),
            Header::title('Description')->sortBy('description'),
            Header::title('Color')->sortBy('color'),
            Header::title('Created')->sortBy('created_at'),
            Header::title('Updated')->sortBy('updated_at'),
        ];
    }

    public function row($model): array
    {
        return [
            $model->id,
            UI::editable($model, 'name'),
            UI::editable($model, 'description'),
            UI::editable($model, 'color'),
            $model->created_at,
            $model->updated_at
        ];
    }

    public function update(Category $category, $data): void
    {
        $category->update($data);
    }
}
