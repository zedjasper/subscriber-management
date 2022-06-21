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

                    <table class="table">
                        @foreach($fields as $field)
                        <tr>
                            <td><label>{{$field->title}}</label></td>
                            <td>
                                @if($field->type == 'boolean')
                                <div class="form-check form-switch">
                                    {{Form::checkbox('field_'.$field->id, 1, null, ['class' => 'form-check-input', 'id'
                                    => 'field_'.$field->id])}}
                                </div>
                                @elseif($field->type == 'number')
                                {{Form::number('field_'.$field->id, null, ['class' => 'form-control numeric'])}}
                                @elseif($field->type == 'date')
                                {{Form::date('field_'.$field->id, null, ['class' => 'form-control'])}}
                                @else
                                {{Form::text('field_'.$field->id, null, ['class' => 'form-control numeric'])}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    
                    <div class="form-group mt-4">
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    @endsection
