@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Job Applications</h5>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">cv</th>
                            <th scope="col">View Job</th>
                            <th scope="col">job_title</th>
                            <th scope="col">company</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($apllications as $apllication)
                            <tr>
                                <th scope="row">{{$apllication->id}}</th>
                                <td><a class="btn btn-success" href="{{asset('assets/cvs/'.$apllication->cv.'')}}">CV</a></td>
                                <td><a class="btn btn-success" href="{{route('single.job',$apllication->job_id)}}">Go To Job</a></td>
                                <td>{{$apllication->job_title}}</td>
                                <td>{{$apllication->company}}</td>
                                <td><a href="#" class="btn btn-danger  text-center ">delete</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
