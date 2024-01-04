@extends('layouts.app')

@section('content')
<main class="flex justify-center items-start w-full h-full pt-32">
      <div
        class="flex flex-col w-full max-w-xl px-4 py-8 bg-primary rounded-lg sm:px-6 md:px-8 lg:px-10"
      >
            <div
          class="self-center mb-6 text-xl font-light text-gray-200 sm:text-2xl"
        >
          Login
        </div>

                <div class="card-body mt-8">
                    <form method="POST" action="{{ route('login') }}" autoComplete="off">
                        @csrf

                        <div class="flex flex-col mb-7">
                            <div class="flex relative">
                                
                                <span class="rounded-l-md inline-flex items-center px-3 border-t bg-primary border-l border-b border-gray-600 text-gray-200 shadow-sm text-sm">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1792 710v794q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-794q44 49 101 87 362 246 497 345 57 42 92.5 65.5t94.5 48 110 24.5h2q51 0 110-24.5t94.5-48 92.5-65.5q170-123 498-345 57-39 100-87zm0-294q0 79-49 151t-122 123q-376 261-468 325-10 7-42.5 30.5t-54 38-52 32.5-57.5 27-50 9h-2q-23 0-50-9t-57.5-27-52-32.5-54-38-42.5-30.5q-91-64-262-182.5t-205-142.5q-62-42-117-115.5t-55-136.5q0-78 41.5-130t118.5-52h1472q65 0 112.5 47t47.5 113z"></path>
                                    </svg>
                                </span>
                                <input type="email" id="email" name="email" class="rounded-r-lg flex-1 appearance-none border border-gray-600 w-full py-2 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-base outline-none" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex flex-col mb-7">
                            <div class="flex relative">
                            <span class="rounded-l-md inline-flex items-center px-3 border-t bg-primary border-l border-b border-gray-600 text-gray-200 shadow-sm text-sm">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1376 768q40 0 68 28t28 68v576q0 40-28 68t-68 28h-960q-40 0-68-28t-28-68v-576q0-40 28-68t68-28h32v-320q0-185 131.5-316.5t316.5-131.5 316.5 131.5 131.5 316.5q0 26-19 45t-45 19h-64q-26 0-45-19t-19-45q0-106-75-181t-181-75-181 75-75 181v320h736z"></path>
                                    </svg>
                                </span>
                                <input type="password" id="password" name="password" class="rounded-r-lg flex-1 appearance-none border border-gray-600 w-full py-2 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-base outline-none" required autocomplete="current-password" placeholder="Password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex w-full mt-10">
                            <button type="submit" class="py-2 px-4 bg-secondary hover:bg-zinc-700 focus:ring-zinc-700 focus:ring-offset-zinc-700 text-white w-full transition ease-in duration-200 text-center text-base font-[500] shadow-md focus:outline-none rounded-lg">
                                {{ __('sign in') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex items-center justify-center mt-6 text-gray-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="inline-flex items-center text-sm font-thin text-center text-gray-200 underline cursor-pointer hover:text-gray-100">
                <span class="ml-2"> Create one </span>
            </a>
        </div>
            </div>
</main>
@endsection
