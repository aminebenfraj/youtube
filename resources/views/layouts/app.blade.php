<html>
<head>
 <title>Vibe View</title>
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
    
    const sidebar = document.querySelector('#sidebar');
   
    const mainBody = document.querySelector('.mainBody');
    
    menu.onclick =  () => {
      sidebar.classList.toggle('show-sidebar');
      mainBody.classList.toggle('expand-body');
    };
  </script>
</body>
</html>