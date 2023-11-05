<?php $is_dashboard = false; $title = 'Timeline Manager - Profile'; $links = ["welcome.css", "profile.css"] ?>
@include('top')
<div class="wrapper bg-white mt-sm-5">
    <h4 class="pb-4 border-bottom">Profile</h4>
    <div class="d-flex align-items-start py-3 border-bottom">
        <img
            src="{{asset('storage/' . $user->avatar)}}"
            onerror="this.onerror=null; this.src='{{ URL::to('images/undraw_profile.svg') }}'"
            class="img" alt="">
        <div class="pl-sm-4 pl-2" id="img-section">
            <b>Profile Photo</b>
            <p>Accepted file type .png.</p>
            <form action="{{route('uploadAvatar')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="file-upload" class="custom-file-upload">
                    <i class="fa fa-cloud-upload"></i> Upload Image
                </label>
                <input id="file-upload" name="file" type="file" style="display:none;"/>
                <input type="submit" value="Save Avatar" class="btn btn-xs btn-info pull-right">
            </form>
        </div>
    </div>
    <form action="{{ route('editProfile') }}" method="post">
        @csrf
        <div class="py-2">
            <div class="row py-2">
                <div class="col-md-6">
                    <label for="email">Username</label>
                    <input type="text" class="bg-light form-control" id="name" name="name" value="<?= $user->name?>">
                </div>
                <div class="col-md-6">
                    <label for="email">Email Address</label>
                    <input type="text" disabled class="bg-light-subtle form-control" id="email" name="email"
                           value="<?= $user->email?>">
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-6">
                    <label for="firstname">First Name</label>
                    <input type="text" class="bg-light form-control" id="first_name" name="first_name"
                           value="<?= $user->first_name?>">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="bg-light form-control" id="last_name" name="last_name"
                           value="<?= $user->last_name?>">
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="bg-light form-control" id="phone" name="phone" value="<?= $user->phone?>">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="phone">Company</label>
                    <input type="tel" class="bg-light form-control" id="company" name="company"
                           value="<?= $user->company?>">
                </div>
            </div>
            <div class="py-3 pb-4 border-bottom">
                <input type="submit" value="Save Changes" class="btn btn-xs btn-info pull-right">
            </div>
        </div>
    </form>
</div>
@include('bottom')
