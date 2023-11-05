<?php

namespace App\Http\Livewire;

use App\Models\TimelineEvent;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class TimelineEventsTableView extends TableView
{
    protected $paginate = 10;
    public $searchBy = ['id', 'user_id', 'title', 'description'];

    protected function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return TimelineEvent::query();
    }

    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('id'),
            Header::title('User')->sortBy('user_id'),
            Header::title('Title')->sortBy('title'),
            Header::title('Description')->sortBy('description'),
            Header::title('Start')->sortBy('start_date'),
            Header::title('End')->sortBy('end_date'),
            'Image',
            'Public',
            Header::title('Created')->sortBy('created_at'),
            Header::title('Updated')->sortBy('updated_at'),
        ];
    }

    public function row($model): array
    {
        return [
            $model->id,
            $model->user_id,
            UI::editable($model, 'title'),
            UI::editable($model, 'description'),
            UI::editable($model, 'start_date'),
            UI::editable($model, 'end_date'),
            $model->image,
            UI::editable($model, 'is_public'),
            $model->created_at,
            $model->updated_at
        ];
    }

    public function update(TimelineEvent $timelineEvent, $data): void
    {
        $timelineEvent->update($data);
    }
}
