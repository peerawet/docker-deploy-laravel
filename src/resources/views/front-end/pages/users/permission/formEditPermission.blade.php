@extends('front-end.layouts.main')

@section('title', 'แก้ไขรายละเอียดแผนก (Edit Role)')

@section('content')
    <div>
        <div class="text-right mb-5">
            @livewire('components.assets.button', ['color' => 'secondary', 'title' => 'กลับสู่หน้าจัดการสิทธ์เข้าใช้งาน', 'icon' => 'corner-up-left', 'route' => 'users.permission.index', 'action' => ''])
        </div>
        <form action="{{ route('users.permission.editPost', ['roleId' => $role->id]) }}" method="POST">
            @csrf
            <div class="page-header">
                <div class="intro-y box p-5 flex flex-col gap-4 h-96">

                    <div>
                        <label for="col-form-label" class="form-label">ชื่่อแผนก (Role)</label>
                        <input type="text" class="form-control w-full" value="{{ $role->name }}">
                    </div>

                    <div class="flex flex-col gap-4">
                        <label for="col-form-label" class="form-label">รายการที่สามารถเข้าถึงได้ (Permission)</label>

                        @foreach ($menus as $menu)
                            <div class="flex items-center gap-4 ml-8">
                                <input type="checkbox" value="{{ $menu->id }}" name="menus[]"
                                    {{ $role->menus->contains($menu->id) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checked-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $menu->title }}</label>
                            </div>
                        @endforeach




                    </div>

                </div>
            </div>

            <div class="text-right mt-5">
                @livewire('components.assets.button-type', ['color' => 'primary', 'title' => 'บันทึกข้อมูล', 'icon' => 'save', 'action' => '', 'type' => 'submit'])
            </div>
        </form>
    </div>

@endsection
