@extends('layouts.app')
    @section('content')
    <div class="row d-flex align-items-center min-vh-100 justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Add Subscriber</h5>
                    {{Form::model($subscriber, ['method' => 'post', 'url' => 'subscribers/store'])}}
                    {{Form::hidden('id')}}

                    @csrf

                    <div class="form-group mb-3">
                        <label>Name</label>
                        {{Form::text('name', null, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        {{Form::email('email', null, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group mb-3">
                        <label class="d-block">State</label>
                        <div class="btn-group mb-3" role="group">
                            @foreach($states as $state)
                            <input type="radio" class="btn-check" @if($subscriber->state == $state) checked @endif value="{{$state}}" name="state" id="{{$state}}" autocomplete="off" />
                            <label class="btn btn-outline-primary btn-sm" for="{{$state}}">{{$state}}</label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="form-group mt-4">
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    @endsection
