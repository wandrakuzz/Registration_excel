@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in Admin Dashboard!
                    </div>
                </div>

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
