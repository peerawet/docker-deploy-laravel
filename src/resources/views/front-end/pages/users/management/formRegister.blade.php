@extends('front-end.layouts.main')
@section('title', 'เพิ่มผู้ใช้งานใหม่')
@section('content')
    <div>
        <div class="text-right mb-5">
            @livewire('components.assets.button', ['color' => 'secondary', 'title' => 'กลับสู่หน้ารายชื่อผู้ใช้งาน', 'icon' => 'corner-up-left', 'route' => 'users.management.index', 'action' => ''])

        </div>
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="page-header">
                <div class="intro-y box p-5 flex flex-col gap-4 h-96">
                    <div>
                        <label for="col-form-label" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control w-full" placeholder="ระบุชื่อพนักงาน" name="name">
                    </div>
                    <div>
                        <label for="col-form-label" class="form-label">Username (ID)</label>
                        <input type="text" class="form-control w-full" placeholder="ระบุชื่อผู้ใช้งาน" name="username">
                    </div>
                    <div>
                        <label for="col-form-label" class="form-label">Password</label>
                        <input type="password" class="form-control w-full" placeholder="ระบุรหัสผ่าน" name="password">
                    </div>
                    <div class="flex flex-col">
                        <label for="col-form-label" class="form-label">โปรดเลือกแผนก (Role)</label>
                        <select id="countries" name="role_id" class="form-control w-full">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="text-right mt-5">
                <button type="submit"
                    class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">เพิ่มผู้ใช้งาน</button>
            </div>
        </form>
    </div>

@endsection
