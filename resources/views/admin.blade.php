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

            @if ($errors->any())
            <div class="alert alert-danger">
                <h3 class="alert-heading m-0">{{ __('Opps! There is an error happened.') }}</h3>
                <hr>
                <ol>
                    @foreach ($errors->all() as $message)
                    <li class="m-0">{{ $message ?? '-' }}</li>
                    @endforeach
                </ol>
            </div>
            @endif

            <form method="post" action="{{ route('excel.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlFile1">Upload information from excel file to the system. Use existing template to make sure all data match with database. Download the template <a href="{{ route('download.template',[ 'path' => 'excel_template.xlsx']) }}">here</a></label>
                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <button type="submit" name="button" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
