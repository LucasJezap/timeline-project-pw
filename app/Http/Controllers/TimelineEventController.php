<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryEditRequest;
use App\Http\Requests\EventEditRequest;
use App\Models\Category;
use App\Models\TimelineEvent;
use App\Models\TimelineEventCategory;
use App\Models\UserSettings;
use App\Traits\Upload;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineEventController extends Controller
{
    use Upload, AuthorizesRequests, ValidatesRequests;

//    public function createEvent(Request $request): RedirectResponse
//    {
//        $request->validate([
//            'title' => 'required|string|max:50',
//            'description' => 'required|string|max:250',
//            'start_date' => 'required|min:8',
//            'end_date' => 'required|min:8',
//            'icon' => '',
//            'image' => '',
//            'is_public' => '',
//        ]);
//
//        TimelineEvent::create([
//            'title' => $request->title,
//            'description' => $request->description,
//            'start_date' => $request->start_date,
//            'end_date' => $request->end_date,
//            'image' => $request->image,
//            'is_public' => $request->is_public
//        ]);
//
//        $credentials = $request->only('email', 'password');
//        Auth::attempt($credentials);
//        $request->session()->regenerate();
//        return redirect()->route('dashboard')
//            ->with('message', 'You have successfully registered & logged in!');
//    }

    public function setFilters(Request $request): RedirectResponse
    {
        $filters = ['title', 'category', 'description', 'start_date', 'end_date'];

        foreach ($filters as $filter) {
            if ($request[$filter] !== "") {
                $value = $request[$filter];
                if (is_array($value)) {
                    $value = implode(',', $value);
                }

                setcookie("filter_" . $filter, $value, 0, '/');
            }
        }

        return redirect()->route('dashboard');
    }

    public function clearFilters(): RedirectResponse
    {
        $filters = ['title', 'category', 'description', 'start_date', 'end_date'];

        foreach ($filters as $filter) {
            setcookie("filter_" . $filter, "", -1, '/');
        }

        return redirect()->route('dashboard');
    }

    public function uploadPoster($event_id, Request $request): RedirectResponse
    {
        $event = TimelineEvent::where('id', $request->id)->first();

        if ($request->hasFile('file')) {
            $path = $this->UploadFile($request->file('file'), "event", $event->id);//use the method in the trait
            $event->image = $path;
            $event->save();

            return redirect()->route('getEventDetails', $event_id);
        }

        return redirect()->route('getEventDetails', $event_id);
    }

    //filters is an associative array composing of elements: column -> value
    public static function eventList(): array
    {
        $events = TimelineEvent::orderBy('start_date', 'asc')->get();
        $full_events = array();
        $fields_to_filter = ['title', 'category', 'description', 'start_date', 'end_date'];

        $user = Auth::user();
        $user_id = 0;
        if ($user !== null) {
            $user_id = $user->id;
        }

        foreach ($events as $event) {
            $is_filtered_out = !$event->is_public && $event->user_id !== $user_id;

            foreach ($fields_to_filter as $field_to_filter) {
                $filterName = 'filter_' . $field_to_filter;
                if (!isset($_COOKIE[$filterName])) {
                    continue;
                }

                if (($field_to_filter === 'title' || $field_to_filter === 'description') && !str_contains(strtolower($event->$field_to_filter), strtolower($_COOKIE[$filterName]))) {
                    $is_filtered_out = true;
                    break;
                }

                if ($field_to_filter === 'category') {
                    foreach (explode(',', $_COOKIE[$filterName]) as $category) {
                        $exists = TimelineEventCategory::join('categories', 'categories.id', '=', 'timeline_event_categories.category_id')->where('timeline_event_id', '=', $event->id)->where('categories.name', '=', $category)->exists();
                        if (!$exists) {
                            $is_filtered_out = true;
                            break;
                        }
                    }
                }

                if ($field_to_filter === 'start_date' && $event->$field_to_filter <= $_COOKIE[$filterName]) {
                    $is_filtered_out = true;
                    break;
                }

                if ($field_to_filter === 'end_date' && $event->$field_to_filter >= $_COOKIE[$filterName]) {
                    $is_filtered_out = true;
                    break;
                }
            }

            if ($is_filtered_out) {
                continue;
            }

            $categories = Category::join('timeline_event_categories', 'categories.id', '=', 'timeline_event_categories.category_id')
                ->select('categories.*')
                ->where('timeline_event_id', '=', $event->id)
                ->get();

            $full_events[] = ['event' => $event, 'categories' => $categories];
        }

        return $full_events;
    }

    public static function upcomingEventList(): array
    {
        $events = self::eventList();
        $upcoming_events = array();

        $notificationDaysBefore = -1;
        $notificationDaysAfter = 7;
        $user = Auth::user();
        if ($user !== null) {
            $userSettings = UserSettings::where('user_id', $user->id)->first();

            if ($userSettings !== null) {
                $notificationDaysBefore = $userSettings->notification_days_before;
                $notificationDaysAfter = $userSettings->notification_days_after;
            }
        }

        foreach ($events as $event) {
            if (strtotime($event['event']->start_date) > strtotime($notificationDaysAfter . ' days')) {
                continue;
            }
            if (strtotime($event['event']->start_date) < strtotime('-' . $notificationDaysBefore . ' days')) {
                continue;
            }

            $upcoming_events[] = $event;
        }

        return $upcoming_events;
    }

    public function getEventDetails($event_id, Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $user = Auth::user();
        $event = TimelineEvent::where('id', $event_id)->first();
        $add_new = false;
        if ($event !== null) {
            $categories = Category::join('timeline_event_categories', 'categories.id', '=', 'timeline_event_categories.category_id')
                ->select('categories.*')
                ->where('timeline_event_id', '=', $event->id)
                ->get();


            $timeline_event = ['event' => $event, 'categories' => $categories];
            return view('event', compact('user', 'timeline_event', 'add_new'));
        }

        return view('event', compact('user', 'add_new'));
    }

    public function addEventView()
    {
        $user = Auth::user();
        $event = new TimelineEvent;
        $event->id = 0;
        $add_new = true;

        $timeline_event = ['event' => $event, 'categories' => collect(new Category())];
        return view('event', compact('user', 'timeline_event', 'add_new'));
    }

    public function addEvent(EventEditRequest $request): RedirectResponse
    {
        $request->validated();

        $event = new TimelineEvent;
        $event->user_id = $request->user()->id;
        $event->title = $request['title'];
        $event->description = $request['description'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->is_public = $request['is_public'] === "on";
        $event->image = "";
        $event->save();

        if ($request['category'] !== null) {
            foreach ($request['category'] as $category_name) {
                $category = Category::where('name', $category_name)->first();

                $eventCategory = new TimelineEventCategory;
                $eventCategory->timeline_event_id = $event->id;
                $eventCategory->category_id = $category->id;
                $eventCategory->save();
            }
        }

        return redirect()->route('getEventDetails', $event);
    }

    public function editEvent($event_id, EventEditRequest $request): RedirectResponse
    {
        $request->validated();

        $event = TimelineEvent::where('id', $event_id)->first();
        if ($event !== null) {
            $event->title = $request['title'];
            $event->description = $request['description'];
            $event->start_date = $request['start_date'];
            $event->end_date = $request['end_date'];
            $event->is_public = $request['is_public'] === "on";
            $event->save();

            if ($request['category'] !== null) {
                $ids = [];
                foreach ($request['category'] as $category_name) {
                    $category = Category::where('name', $category_name)->first();

                    $eventCategory = TimelineEventCategory::where('category_id', $category->id)->where('timeline_event_id', $event->id)->first();
                    if ($eventCategory === null) {
                        $eventCategory = new TimelineEventCategory;
                        $eventCategory->timeline_event_id = $event->id;
                        $eventCategory->category_id = $category->id;
                        $eventCategory->save();
                    }

                    $ids[] = $eventCategory->id;
                }

                foreach (TimelineEventCategory::where('timeline_event_id', $event_id)->get() as $event_category) {
                    if (!in_array($event_category->id, $ids, true)) {
                        TimelineEventCategory::where('id', $event_category->id)->delete();
                    }
                }
            }
        }

        return redirect()->route('getEventDetails', $event);
    }

    public function deleteEvent($event_id): RedirectResponse
    {
        TimelineEvent::where('id', $event_id)->delete();

        return redirect()->route('dashboard');
    }

    public function getCategoryDetails($category_id, Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $user = Auth::user();
        $category = Category::where('id', $category_id)->first();
        $add_new = false;

        return view('category', compact('user', 'category', 'add_new'));
    }

    public function addCategoryView()
    {
        $user = Auth::user();
        $category = new Category;
        $category->id = 0;
        $add_new = true;

        return view('category', compact('user', 'category', 'add_new'));
    }

    public function addCategory(CategoryEditRequest $request): RedirectResponse
    {
        $request->validated();

        $category = new Category;
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->color = $request['color'];
        $category->save();

        return redirect()->route('getCategoryDetails', $category);
    }

    public function editCategory($category_id, CategoryEditRequest $request): RedirectResponse
    {
        $request->validated();

        $category = Category::where('id', $category_id)->first();
        if ($category !== null) {
            $category->name = $request['name'];
            $category->description = $request['description'];
            $category->color = $request['color'];
            $category->save();
        }

        return redirect()->route('getCategoryDetails', $category);
    }

    public function deleteCategory($category_id): RedirectResponse
    {
        Category::where('id', $category_id)->delete();

        return redirect()->route('dashboard');
    }
}
