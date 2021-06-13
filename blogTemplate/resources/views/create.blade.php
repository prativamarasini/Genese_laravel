@extends('layout')
@section('content')
<div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        <form action='/create/store' method="POST">
            @csrf
            Post Title: <input type = 'text' name='title' class="form-control"><br><br>
            Post Content: <textarea name="description" class="form-control"></textarea><br><br>
            Published by:<input type = 'text' name='publisher' class="form-control"><br><br>
            Publisher Post: <input type = 'text' name='publisher_post' class="form-control"><br><br>
            <input type="submit" name="submit" value="save" class="btn btn-primary btn-block"><br><br>
        </form>
      </div>
    </div>
</div>
@endsection