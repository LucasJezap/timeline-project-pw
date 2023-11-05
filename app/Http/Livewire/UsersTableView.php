<?php

namespace App\Http\Livewire;

use App\Models\User;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class UsersTableView extends TableView
{
    protected $paginate = 10;
    public $searchBy = ['id', 'name', 'email'];

    protected function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query();
    }

    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('id'),
            Header::title('Name')->sortBy('name'),
            Header::title('Email')->sortBy('email'),
            'Password (Hash)',
            Header::title('Created')->sortBy('created_at'),
            Header::title('Updated')->sortBy('updated_at'),
        ];
    }

    public function row($model): array
    {
        return [
            $model->id,
            UI::editable($model, 'name'),
            $model->email,
            $model->password,
            $model->created_at,
            $model->updated_at
        ];
    }

    public function update(User $user, $data): void
    {
        $user->update($data);
    }
}
