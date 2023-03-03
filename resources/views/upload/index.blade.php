@extends('upload.layout.master')

@section('title', 'Home')

@section('content')
  <h1>Welcome to my website!</h1>
  {{-- <h1>{{auth()->user->name}}</h1> --}}
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Profile</th>
        <th>Gallery</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($uploads as $upload)
        <tr>
          <td>{{ $upload->title }}</td>
          <td>{{ $upload->description }}</td>
          <td>
            <img src="{{ asset('uploads/' . $upload->profile) }}" alt="{{ $upload->title }}" class="img-thumbnail">
          </td>
          <td>
            {{-- @foreach ($upload->attachments as $attachment) --}}
              {{-- <img src="{{ asset($attachment->filepath) }}" alt="{{ $attachment->filename }}" class="img-thumbnail"> --}}
            {{-- @endforeach --}}
          </td>
          <td>

            <a href="{{ route('upload.edit', $upload->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('upload.destroy', $upload->id) }}" method="POST" style="display: inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection
