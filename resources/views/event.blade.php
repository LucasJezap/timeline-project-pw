<?php $is_dashboard = false; $title = 'Timeline Manager - Event'; $links = ["welcome.css", "event.css"]; $is_auth = auth()->check(); ?>
@include('top')
<div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="row">
                <div class="col-md-12 d-flex align-items-center py-3 border-bottom">
                    <img
                            src="{{asset('storage/' . $timeline_event['event']->image)}}"
                            onerror="this.onerror=null; this.src='{{ URL::to('images/undraw_poster.png') }}'"
                            class="img-fluid" alt="">
                </div>
                <?php if ($is_auth && !$add_new) { ?>
                <div
                        class="col-md-12 d-flex justify-content-center align-items-center text-center py-3 border-bottom">
                    <div class="pl-sm-4 pl-2" id="img-section">
                        <b>Poster</b>
                        <p>Accepted file type .png.</p>
                        <form action="{{route('uploadPoster', $timeline_event['event']->id)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <label for="file-upload" class="custom-file-upload d-block">
                                <i class="fa fa-cloud-upload"></i> Upload Image
                            </label>
                            <input id="file-upload" name="file" type="file" style="display:none;"/>
                            <input type="submit" value="Save Poster" class="btn btn-xs btn-info pull-right">
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-8">
            <form action="{{ $add_new? route('addEvent'): route('editEvent', $timeline_event['event']->id)}}"
                  method="post">
                @csrf
                <div class="p-3 py-5">
                    <label for="title">Title</label>
                    <div class="row mt-2" style="margin-bottom: 20px;">
                        <div class="col-md-12"><input <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> type="text" class="form-control" id="title" name="title"
                                                      value="<?= $timeline_event['event']->title ?>"></div>
                    </div>
                    <label for="description">Description</label>
                    <div class="row mt-3" style="margin-bottom: 20px;">
                        <div class="col-md-12"><textarea <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> type="text" class="form-control" id="description"
                                                         name="description"
                                                         rows="3    "><?= $timeline_event['event']->description ?></textarea>
                        </div>
                    </div>
                    <label for="start_date">Start Date</label>
                    <div class="row mt-3" style="margin-bottom: 20px;">
                        <div class="col-md-12"><input <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> type="datetime-local" class="form-control" id="start_date"
                                                      name="start_date"
                                                      value="<?= $timeline_event['event']->start_date ?>"></div>
                    </div>
                    <label for="end_date">End Date</label>
                    <div class="row mt-3" style="margin-bottom: 20px;">
                        <div class="col-md-12"><input <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> type="datetime-local" class="form-control" id="end_date"
                                                      name="end_date"
                                                      value="<?= $timeline_event['event']->end_date ?>"></div>
                    </div>
                    <label for="category">Categories</label>
                    <div class="row mt-3" style="margin-bottom: 20px">
                        <div class="col-md-12">
                            <select <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> multiple class="form-control" id="category" name="category[]"
                                    aria-label="category"
                                    style="width:100%;">
                                <?php foreach (\App\Http\Controllers\CategoryController::categoryList() as $key => $category): ?>
                                <option <?php if (in_array($category->name, array_column($timeline_event['categories']->toArray(), 'name'), true)) {
                                    echo "selected";
                                } ?> value="<?= $category->name ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    @auth
                        <label for="is_public">Is Public</label>
                        <div class="row mt-3">
                            <div class="col-md-2"><input type="checkbox" class="form-control" id="is_public"
                                                         name="is_public"
                                    <?php if ($timeline_event['event']->is_public === 1) {
                                        echo "checked";
                                    } ?>>
                            </div>
                        </div>
                        <div class="mt-5 text-right">
                            <input type="submit" value="<?php echo $add_new? "Add": "Save"?> Event" class="btn btn-xs btn-info pull-right">
                        </div>
                    @endauth
                </div>
            </form>
        </div>
    </div>
</div>
@include('bottom')
