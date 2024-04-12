@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header">
                        <a href="{{ route('todo.index') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
                    </h5>
                </div>

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

                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session()->get('error') }}
                    </div>
                    @endif

                    <form id="decryptForm" action="{{ route('todo.show') }}" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label for="decryption_key" class="col-form-label text-md-center">Enter Decryption key</label>
                            <input id="decryption_key" type="text" class="form-control @error('decryption_key') is-invalid @enderror" name="decryption_key" required autofocus>
                            @error('decryption_key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-primary" onclick="validateDecryptionKey()">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateDecryptionKey() {
        var decryptionKey = document.getElementById('decryption_key').value;
        // Add your custom validation logic here
        if (decryptionKey.trim() === '') {
            alert('Please enter a decryption key.');
            return;
        }

        document.getElementById('decryptForm').submit();
    }
</script>

@endsection
