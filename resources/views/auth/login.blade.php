@extends('auth.layouts.auth')

@section('title')
 Login
@endsection

@section('auth-content')
   <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Insurance Software" class="w-6" src="/assets/images/logo.png">
                        <span class="text-white text-lg ml-3"> {{substr(config('app.name'),0,2)}}<span class="font-medium">{{substr(config('app.name'),2)}}</span> </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to
                            <br>
                            sign in to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">Manage all your work demands in one place</div>
                    </div>
                </div>

                    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                                Login
                            </h2>
                            <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your work demands in one place</div>
                            <form action="{{route('login')}}" method="post" autocomplete="off">
                                @csrf
                                @if (session()->has('error'))
                                <div class="rounded-md px-5 py-4 mb-2 bg-theme-12 text-white">{!! session()->get('error') !!}</div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="rounded-md px-5 py-4 mb-2 bg-theme-12 text-white">{!! session()->get('success') !!}</div>
                                @endif
                                <div class="intro-x mt-8">
                                    <input type="text" name="email" autocomplete="off" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email address">
                                    @error('email')
                                        <i><small style="color: #ff0000;">{{$message}}</small></i>
                                    @enderror
                                    <input type="password" name="password" autocomplete="off" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
                                </div>
                                <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                                    <div class="flex items-center mr-auto">
                                        <input type="checkbox" class="input border mr-2" name="remember" id="remember-me">
                                        <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                    </div>
<!--                                    <a href="">Forgot Password?</a>-->
                                </div>
                                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                    <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
@endsection
