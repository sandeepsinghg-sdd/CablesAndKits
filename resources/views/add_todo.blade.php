@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Message
                </div>
                <h5 class="card-header">
                    <a href="{{ route('todo.index') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
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

                    @if(session()->has('error')) <!-- Added this condition to display custom error message -->
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('todo.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-form-label text-md-right">Enter Email ID</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-form-label text-md-right">Message</label>

                            <textarea name="message" id="message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" autocomplete="message">{{ old('message') }}</textarea>

                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="completed" id="completed" value="1" {{ old('completed') ? 'checked' : '' }}>

                                <label class="form-check-label" for="completed">
                                    Completed?
                                </label>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
