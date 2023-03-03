@extends('upload.layout.master')
@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Create Role</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="privacy" required>
                            </div>

                            <div class="form-group">
                                <label>Blog Capabilities:</label><br>
                                @foreach ($blogCapabilities as $capability)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $capability }}" id="permission{{ $loop->iteration }}">
                                        <label class="form-check-label" for="permission{{ $loop->iteration }}">
                                            {{ $capability }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                            <div class="col-md-6">
                                <select id="role_id" class="form-control @error('role_id') is-invalid @enderror"
                                    name="role_id" required>
                                    <option value="">{{ __('Select a role') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
