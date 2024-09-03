@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col=md-12 cm-margin">
            <div class="card">
                <div class="card-header">{{ __('Add Vendor') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                    @endif
                    <div class="col-md-4">
                        <form method="POST" action="{{ url('insert_vendor') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                            
                            <div class="form-group row">
                                <label for="vendor_name" class="col-form-label text-md-right">{{ __('Vendor Name') }}</label>
                                <input id="vendor_name" type="text" class="form-control @error('vendor_name') is-invalid @enderror" name="vendor_name" value="{{ old('vendor_name') }}" required autocomplete="email">
                                @error('vendor_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div>
                                <label for="address" class=" col-form-label text-md-right">{{ __('Address') }}</label>
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="3" cols="4"> </textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="contact_no" class="col-form-label text-md-right">{{ __('Contact Number') }}</label>
                                <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" autocomplete="contact_number" pattern="^\d{10}$">
                                @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            </br>
                            <div class=" row mb-0">
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-save-width">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{url('/product')}}" class="btn btn-secondary btn-save-width">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div>
                            <table id="table_id" class="table table-condensed table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            Vendor Name
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        <th>
                                            Contact Number
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
                                    @foreach($data as $data)
                                    <tr>
                                        <td>
                                            {{$data->vendor_name}}
                                        </td>
                                        <td class="cell expand-maximum-on-hover">
                                            {{$data->address}}
                                        </td>
                                        <td>
                                            {{$data->contact_number}}
                                        </td>
                                        <td>
                                            @if($data->status == 'active')
                                                Active
                                            @else
                                                In-Active
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-primary edit" href="{{ url('edit_vendor/'.$data->id) }}">Edit</a>
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
</div>
@endsection