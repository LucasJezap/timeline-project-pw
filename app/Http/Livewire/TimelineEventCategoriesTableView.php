<?php

namespace App\Http\Livewire;

use App\Models\TimelineEventCategory;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class TimelineEventCategoriesTableView extends TableView
{
    protected $paginate = 10;
    public $searchBy = ['id', 'timeline_event_id', 'category_id'];

    protected function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return TimelineEventCategory::query();
    }

    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('id'),
            Header::title('Timeline Event')->sortBy('timeline_event_id'),
            Header::title('Category')->sortBy('category_id'),
            Header::title('Created')->sortBy('created_at'),
            Header::title('Updated')->sortBy('updated_at'),
        ];
    }

    public function row($model): array
    {
        return [
            $model->id,
            $model->timeline_event_id,
            $model->category_id,
            $model->created_at,
            $model->updated_at
        ];
    }

    public function update(TimelineEventCategory $timelineEventCategory, $data): void
    {
        $timelineEventCategory->update($data);
    }
}
