<?php

namespace App\Livewire\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait DeleteAlert
{
    use LivewireAlert;
    public $ids = [];

    public function delete()
    {
        if (empty ($this->ids)) {
            $this->alert('error', 'เกิดข้อผิดพลาด', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => 'โปรดเลือกรายการที่ต้องการลบ',
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
            return;
        }

        $this->confirm('ลบข้อมูล', [
            'toast' => false,
            'text' => 'คุณต้องการลบข้อมูลใบเสนอราคาใช่หรือไม่?',
            'position' => 'center',
            'progressBar' => false,
            'showCancelButton' => true,
            'confirmButtonText' => 'ยืนยัน',
            'cancelButtonText' => 'ยกเลิก',
            'onConfirmed' => 'acceptDelete',
        ]);
    }

    public function acceptDelete()
    {
        return $this->alert('success', 'ลบข้อมูลสำเร็จ', [
            'position' => 'bottom',
        ]);
    }
}
