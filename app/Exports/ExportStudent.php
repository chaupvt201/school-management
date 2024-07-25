<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User; 



class ExportStudent implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array 
    {
        return [
            "ID",
            "Họ và tên", 
            "Email", 
            "Lớp", 
            "Giới tính", 
            "Ngày sinh", 
            "Số điện thoại", 
            "Trạng thái"

        ];
    }
    public function map($value): array 
    { 
        $student_name = $value->last_name.' '.$value->first_name; 
        $date_of_birth = ''; 
        if(!empty($value->date_of_birth))
        {
            $date_of_birth = date('d-m-Y', strtotime($value->date_of_birth)); 
        } 
        $status = ($value->status == 0) ? 'Kích hoạt' : 'Không kích hoạt'; 
        return [
            $value->id, 
            $student_name, 
            $value->email, 
            $value->class_name,
            $value->gender, 
            $date_of_birth, 
            $value->mobile_number,
            $status
        ]; 
    } 
    public function collection() 
    { 
        $remove_pagination = 1;
        return User::getStudent($remove_pagination); 
    }
}
