@extends('front-end.authentication.layouts')
@section('title', 'เข้าสู่ระบบ')
@section('content')
    <div
        class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            เข้าใช้งานระบบ
        </h2>

        <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
            A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place.
        </div>

        <div class="intro-x mt-8">
            <form id="login-form" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
                    <input type="text" id="username" class="intro-x login__input form-control"
                        placeholder="โปรดระบุชื่อผู้ใช้ เช่น somchai" name="username">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" id="password" class="intro-x login__input form-control"
                        placeholder="โปรดระบุรหัสผ่าน" name="password">
                </div>

                <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                    <div class="flex items-center mr-auto">
                        <input id="remember-me" type="checkbox" name="remember" class="form-check-input border mr-2">
                        <label class="cursor-pointer select-none" for="remember-me">จดจำฉันไว้ในระบบ</label>
                    </div>
                </div>

                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button type="submit"
                        class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">เข้าสู่ระบบ</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const rememberMeCheckbox = document.getElementById('remember-me');
            const usernameInput = document.getElementById('username');

            // Check if username is saved in local storage
            if (localStorage.getItem('rememberUsername') === 'true') {
                usernameInput.value = localStorage.getItem('username');
                rememberMeCheckbox.checked = true;
            }

            // Save username to local storage when form is submitted
            document.getElementById('login-form').addEventListener('submit', (event) => {
                if (rememberMeCheckbox.checked) {
                    localStorage.setItem('username', usernameInput.value);
                    localStorage.setItem('rememberUsername', 'true');
                } else {
                    localStorage.removeItem('username');
                    localStorage.removeItem('rememberUsername');
                }
            });
        });
    </script>
@endsection
