@extends('auth.layouts.auth')

@section('title')
 Reset Password
@endsection

@section('auth-content')
   <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
                        <span class="text-white text-lg ml-3"> Mid<span class="font-medium">One</span> </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Forgot your password?
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</div>
                    </div>
                </div>
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Reset Password
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Let's help you recover your account.</div>
                        <div class="intro-x mt-8">
                            <input type="text" autocomplete="off" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email Address">
                        </div>
                        <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                            <p>Remember your password? <a href="{{route('login')}}">Login</a> </p>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="button button--lg w-full xl:w-100 text-white bg-theme-1 xl:mr-3 align-top">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection