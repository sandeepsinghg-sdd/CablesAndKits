@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Message {{ $todo->title }}
                </div>
                <h5 class="card-header">
                    <a href="{{ route('todo.index') }}" class="btn btn-sm btn-outline-primary"><i
                            class="fa fa-arrow-left"></i> Go Back</a>
                </h5>

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

                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session()->get('success') }}
                    </div>
                    @endif


                    <div class="form-group row">
                    
                        <div class="col-md-6">
                            <p class="form-control-static">
                                {{ $todo->decrypted_message }}
                            </p>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection