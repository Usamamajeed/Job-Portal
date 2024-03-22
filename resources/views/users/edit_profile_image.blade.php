@extends('layouts.app')

@section('content')
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{asset('assets/images/hero_1.jpg')}}); margin-top: -24px;" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Update User Image</h1>
                    <div class="custom-breadcrumbs">
                        <a href="#">Home</a> <span class="mx-2 slash">/</span>
                        <a href="#">Job</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Update User Image</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="site-section">
        <div class="container">

            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2>Update User Image</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <form class="p-4 p-md-5 border rounded" enctype="multipart/form-data" action="{{route('update.image')}}" method="post">
                        @csrf
                        <!--job details-->

                        <div class="form-group">
                            <label for="job-title">User Image</label>
                            <input type="file" name="user_image" class="form-control" id="user_image" placeholder="CV">
                        </div>

                        <div class="col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" class="btn btn-block btn-primary btn-md" style="margin-left: 200px;" value="Update">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </section>


@endsection
