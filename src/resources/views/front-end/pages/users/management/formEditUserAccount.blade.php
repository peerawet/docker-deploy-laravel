@extends('front-end.layouts.main')

@section('title', 'แก้ไขผู้ใช้งาน')

@section('content')

    <div>
        <div class="text-right mb-5">
            @livewire('components.assets.button', ['color' => 'secondary', 'title' => 'กลับสู่หน้ารายชื่อผู้ใช้งาน', 'icon' => 'corner-up-left', 'route' => 'users.management.index', 'action' => ''])
        </div>
        <form action="{{ route('update.post', ['userId' => $user->id]) }}" method="POST">
            @csrf
            <div class="page-header">
                <div class="intro-y box p-5 flex flex-col gap-4 h-96">
                    <div>
                        <label for="col-form-label" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control w-full" placeholder="ระบุชื่อพนักงาน" name="name"
                            value="{{ $user->name }}">
                    </div>
                    <div>
                        <label for="col-form-label" class="form-label">Username (ID)</label>
                        <input type="text" class="form-control w-full" placeholder="ระบุชื่อผู้ใช้งาน" name="username"
                            value="{{ $user->username }}" readonly>
                    </div>


                    <div>
                        <label for="col-form-label" class="form-label">Password</label>
                        <input type="password" class="form-control w-full" placeholder="ระบุรหัสผ่านใหม่" name="password">
                    </div>
                    <div class="flex flex-col">
                        <label for="col-form-label" class="form-label">โปรดเลือกแผนก (Role)</label>
                        <select id="countries" name="role_id" class="form-control w-full">
                            <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Manager</option>
                            <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Accounting</option>
                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Sale and Marketing
                            </option>
                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-right mt-5">
                @livewire('components.assets.button-type', ['color' => 'primary', 'title' => 'บันทึกข้อมูล', 'icon' => 'save', 'action' => '', 'type' => 'submit'])
            </div>
        </form>
    </div>


@endsection
