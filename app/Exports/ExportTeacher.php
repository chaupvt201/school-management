<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping; 
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User; 

class ExportTeacher implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array 
    {
        return [
            "Mã giáo viên", 
            "Họ tên", 
            "Email",
            "Giới tính", 
            "Ngày sinh", 
            "Số điện thoại", 
            "Trình trạng kết hôn", 
            "Địa chỉ", 
            "Trình độ", 
            "Trạng thái"
        ]; 
    } 
    public function map($value): array 
    { 
        $teacher_name = $value->last_name.' '.$value->first_name; 
        if(!empty($value->date_of_birth))
        {
            $date_of_birth = date('d-m-Y', strtotime($value->date_of_birth)); 
        } 
        $status= ($value->status == 0) ? 'Kích hoạt' : 'Không kích hoạt'; 
        return [
            $value->id, 
            $teacher_name, 
            $value->email,
            $value->gender,
            $date_of_birth,
            $value->mobile_number,
            $value->marital_status, 
            $value->address,
            $value->qualification, 
            $status
        ]; 
    }
    public function collection()
    {
        $remove_pagination = 1; 
        return User::getTeacher($remove_pagination); 
    }
}
