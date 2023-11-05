<?php

namespace App\Http\Livewire;

use App\Models\UserSettings;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class UserSettingsTableView extends TableView
{
    protected $paginate = 10;
    public $searchBy = ['id', 'name', 'description', 'color'];

    protected function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return UserSettings::query();
    }

    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('id'),
            Header::title('User')->sortBy('user_id'),
            Header::title('Notification Days Before')->sortBy('notification_days_before'),
            Header::title('Notification Days After')->sortBy('notification_days_after'),
            Header::title('Created')->sortBy('created_at'),
            Header::title('Updated')->sortBy('updated_at'),
        ];
    }

    public function row($model): array
    {
        return [
            $model->id,
            $model->user_id,
            UI::editable($model, 'notification_days_before'),
            UI::editable($model, 'notification_days_after'),
            $model->created_at,
            $model->updated_at
        ];
    }

    public function update(UserSettings $userSettings, $data): void
    {
        $userSettings->update($data);
    }
}
