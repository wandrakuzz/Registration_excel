@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        You are logged in Admin Dashboard!
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h3 class="alert-heading m-0">{{ __('Opps! There is an error happened.') }}</h3>
                        <hr>
                        {{-- <p class="d-block">{{ __('Please check your data in excel template again. Please use Lookup sheet as a value reference. Below are the description of an errors happened. If anything problems is happening. Contact us.') }}</p> --}}
                        <ol>
                            @foreach ($errors->all() as $message)
                        {{-- {{dd($message)}} --}}
                                <li class="m-0">{{ $message ?? '-' }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                <form method="post" action="{{ route('excel.import') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                    <label for="exampleFormControlFile1">Example file input</label>
                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                  </div>
                  <button type="submit" name="button">Upload</button>
                </form>
            </div>
        </div>
    </div>
@endsection
