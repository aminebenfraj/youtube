@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Sign up</button>
    </form>
</div> -->
<div class="w-full h-full">
      <h1>Recommended</h1>

      <div class="flex justify-around flex-wrap">
       
        <div class="w-80 mb-7">
          <div class="w-full h-40">
            <img src="https://img.youtube.com/vi/PpXUTUXU7Qc/maxresdefault.jpg" alt="" class="bg-cover h-full w-full" />
          </div>
          <div class="video__details">
            <div class="author">
              <img src="http://aninex.com/images/srvc/web_de_icon.png" alt="" class="" />
            </div>
            <div class="title">
              <h3>
                Top 5 Programming Languages to Learn in 2021 | Best Programming Languages to Learn
              </h3>
              <a href="">FutureCoders</a>
              <span>10M Views • 3 Months Ago</span>
            </div>
          </div>
        </div>
       

        
      </div>
    </div>
@endsection
