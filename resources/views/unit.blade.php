@extends('layouts.app_new')

@section('content')

<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card ">
                <div class="card-header">{{ __('Add Unit') }}</div>
                @if(session()->has('message'))
                <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-body">
                            <form method="POST" action="{{ url('insert_unit') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">

                                <div class="">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Unit Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="email">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                </br>
                                <div class="form-group row mb-0">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary btn-save-width">
                                            {{ __('Save') }}
                                        </button>
                                        <a href="{{url('/unit')}}" class="btn btn-secondary btn-save-width">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table id="table_id" class="table table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Unit Name
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($data as $k =>$v)
                                <tr>
                                    <td>
                                        {{$v['name']}}
                                    </td>
                                    <td>
                                        @if($v['is_active'] == 1)
                                        Active
                                        @else
                                        InActive
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-primary edit" href="{{url('edit_unit/'.$v['id'])}}">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection