<html>
<head>
 <title>Youtube</title>
 <link href="{{ asset('simplelogo.png') }}" rel="icon" />
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
 @vite('resources/css/app.css')
 @cloudinaryJS
</head>
<body>
    <div class='wrapper'>
        @include('layouts.navbar')
        <div class="mainBody flex w-full items-start">
         @include('layouts.sidebar')
        @show
        <div class="w-full h-full overflow-y-scroll">
        @yield('content')
        </div> 
        </div>
    </div>
    <script>
    const menu = document.querySelector('#menu');
    console.log(1);
    const sidebar = document.querySelector('#sidebar');
    console.log(2);
    const mainBody = document.querySelector('.mainBody');
    console.log(2);
    menu.onclick =  () => {
      sidebar.classList.toggle('show-sidebar');
      mainBody.classList.toggle('expand-body');
    };
  </script>
</body>
</html>