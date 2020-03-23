<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function getRecords()
    {
        $records = User::where('status', 'Active')->paginate(5)->onEachSide(1);
        //return view('home.pagination', compact('records'));
        return response()->json(['data'=> $records, 'pagination'=>(string) $records->links()]);
    }

    public function saveRecords(Request $request)
    {
        $record = $request->get('id') === null ? new User() : User::find($request->get('id'));
        $record->name = $request->get('name');
        $record->email = $request->get('email');
        $record->mobile_number = $request->get('mobile_number');
        $record->status = $request->get('status');
        $request->get('narrative') === null ? $record->narrative = '---' : $record->narrative = $request->get('narrative');
        $request->get('id') === null ? $record->created_by = session('id') : $record->updated_by = session('id');
        $record->save();
        //return redirect('get/user/record/null?page=2');
        return response()->json($record);
    }

    public function getRecord(Request $request)
    {
        return response()->json(User::where('id', $request->get('id'))->first());
    }
}
