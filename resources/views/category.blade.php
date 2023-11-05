<?php $is_dashboard = false; $title = 'Timeline Manager - Category'; $links = ["welcome.css", "event.css"]; $is_auth = auth()->check(); ?>
@include('top')
<div class="container rounded bg-white mt-5">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                    <?php foreach ($errors->all() as $error): ?>
                <li>{!! $error !!}</li>
                <?php endforeach; ?>
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                @csrf
                <div class="p-3 py-5">
                    <label for="name">Name</label>
                    <div class="row mt-2" style="margin-bottom: 20px;">
                        <div class="col-md-12"><input <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> type="text" class="form-control" id="name" name="name"
                                                      value="<?= $category->name ?>"></div>
                    </div>
                    <label for="description">Description</label>
                    <div class="row mt-3" style="margin-bottom: 20px;">
                        <div class="col-md-12"><textarea <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> type="text" class="form-control" id="description"
                                                         name="description"
                                                         rows="3    "><?= $category->description ?></textarea>
                        </div>
                    </div>
                    <label for="color">Color</label>
                    <div class="row mt-3" style="margin-bottom: 20px;">
                        <div class="col-md-12"><input <?php if (!$is_auth) {
                                echo 'disabled';
                            } ?> type="color" class="form-control" id="color"
                                                      name="color" value="<?= $category->color ?>">
                        </div>
                    </div>
                    @auth
                        <div class="mt-5 text-right">
                            <?php if (!$add_new): ?>
                            <button type="submit" class="btn btn-danger submitBtn"
                                    formaction="{{route('deleteCategory', $category->id)}}">
                                Delete Category
                            </button>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-info submitBtn"
                                    formaction="{{ $add_new? route('addCategory'): route('editCategory', $category->id) }}">
                                <?php echo $add_new ? "Add" : "Save" ?> Category
                            </button>
                        </div>
                    @endauth
                </div>
            </form>
        </div>
    </div>
</div>
@include('bottom')
