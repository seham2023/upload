@extends('upload.layout.master')
@section('title', 'Home')

@section('content')
  <h1>Welcome to my website!</h1>
  <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
      @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
   
    <div class="form-group">
      <label for="gallery[]">Gallery</label>
      <input type="file" class="form-control-file @error('gallery.*') is-invalid @enderror" id="gallery" name="gallery[]" multiple>
      @error('gallery.*')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="profile">Profile</label>
      <input type="file" class="form-control-file @error('profile') is-invalid @enderror" id="profile" name="profile">
      @error('profile')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection
