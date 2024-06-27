<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\User; 
use App\Models\Admin; 
use Illuminate\Support\Facades\DB; 
use Hash; 

class AdminController extends Controller
{
    public function list() 
    { 
        $data['getRecord'] = User::getRecord(); 
        $data['header_title'] = 'Admin List'; 
        return view('admin.admin.list', $data); 
    } 
    public function add() 
    {
        $data['header_title'] = 'Add New Admin'; 
        return view('admin.admin.add', $data); 
    } 
    public function insert(Request $request) 
    { 
        request()->validate([
            'email' =>'required|email|unique:users'
        ]); 
        $user = new User; 
        $user->email = trim($request->email); 
        $user->password = Hash::make($request->password); 
        $user->user_type = 1; 
        $user->save(); 
        $id = $user->id; 
        $admin = new Admin; 
        $admin->admin_name = trim($request->name); 
        $admin->user_id = $id; 
        $admin->save(); 

        return redirect('admin/admin/list')->with('success', 'Admin successfully created'); 
    } 
    public function edit($id) 
    { 
        //$data['getRecord'] = User::getSingle($id); 
       $data['getRecord'] = DB::table('users')->join('admin', 'users.id', '=','admin.user_id')->where('users.id', $id)->select('users.*', 'admin.admin_name as name')->get(); 
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = 'Edit Admin'; 
            return view('admin.admin.edit', $data); 
        } 
        else 
        {
            abort(404); 
        }
        
    } 
    public function update($id, Request $request) 
    { 
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]); 
        $user = User::getSingle($id); 
        $user->email = trim($request->email); 
        if(!empty($request->password)) 
        {
            $user->password = Hash::make($request->password); 
        } 
        $user->save(); 
        DB::table('admin')
             ->where('user_id', $id)
             ->update(['admin_name'=> trim($request->name)]); 
        
        return redirect('admin/admin/list')->with('success', 'Admin successfully updated'); 
    } 
    public function delete($id) 
    { 
        DB::table('admin')->where('user_id', $id)->delete(); 
        $user = User::getSingle($id); 
        $user->delete(); 


        return redirect('admin/admin/list')->with('success', 'Admin successfully deleted'); 
    }
}
