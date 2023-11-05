</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="non-printable sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2023 Łukasz Jezapkowicz</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="non-printable scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="non-printable modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <form action="{{ route('logout') }}" method="post" style="display: inline" class="">
                @csrf
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Logout</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Filter Modal Start-->
<div class="modal fade text-center" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="Filter data dialog">
    <div class="modal-dialog d-inline-block" style="max-width: 100%;width: auto !important;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <h1>
                Filter Data
            </h1>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <form method="post" class="form-inline" role="form"
                          id="filter_form">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Enter event title..." aria-label="title" style="width:100%;"
                                       value="<?= isset($_COOKIE['filter_title'])? $_COOKIE['filter_title']: '' ?>">
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 20px">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select multiple class="form-control" id="category" name="category[]"
                                        aria-label="category"
                                        style="width:100%;">
                                    <?php foreach (\App\Http\Controllers\CategoryController::categoryList() as $key => $category): ?>
                                    <option <?php if (isset($_COOKIE['filter_category']) && str_contains($_COOKIE['filter_category'], $category->name)) {
                                        echo "selected";
                                    } ?> value="<?= $category->name ?>"><?= $category->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 20px">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Enter description..." aria-label="description" style="width:100%;"
                                       value="<?= isset($_COOKIE['filter_description']) ? $_COOKIE['filter_description']: '' ?>">
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 20px">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                       placeholder="Enter start date..." aria-label="start_date" style="width:100%"
                                       value="<?= isset($_COOKIE['filter_start_date']) ? $_COOKIE['filter_start_date']: '' ?>">
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 20px">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                       placeholder="Enter end date..." aria-label="end_date" style="width:100%;"
                                       value="<?= isset($_COOKIE['filter_end_date']) ? $_COOKIE['filter_end_date']: '' ?>">
                            </div>
                        </div>

                        <div class="col-md-12" style="padding-top: 2rem; margin-bottom: 20px">
                            <button type="submit" class="btn btn-primary submitBtn"
                                    formaction="{{route('setFilters')}}">
                                Filter
                            </button>
                            <button type="submit" class="btn btn-primary submitBtn"
                                    formaction="{{route('clearFilters')}}">
                                Clear All Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Filter Modal End-->

<!-- Bootstrap core JavaScript-->
<script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ URL::to('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ URL::to('js/dashboard.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ URL::to('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ URL::to('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ URL::to('js/demo/chart-pie-demo.js') }}"></script>

<script>
    $('#file-upload').change(function () {
        $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
        $(this).prev('label').text(file);
    });
</script>
@laravelViewsScripts
</body>
</html>
