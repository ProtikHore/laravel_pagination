<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function getRecords($searchKey)
    {
        $records =  User::where(function ($query) use ($searchKey) {
            if ($searchKey !== 'null') {
                $query->where('name', 'like', '%' . $searchKey . '%');
                $query->orWhere('email', 'like', '%' . $searchKey . '%');
                $query->orWhere('mobile_number', 'like', '%' . $searchKey . '%');
                $query->orWhere('status', 'like', '%' . $searchKey . '%');
                $query->orWhere('narrative', 'like', '%' . $searchKey . '%');
            }
        })->paginate(5)->onEachSide(1);

       // $records = User::paginate(5)->onEachSide(1);
        //return view('home.pagination', compact('records'));
        return response()->json(['data'=> $records, 'pagination'=>(string) $records->links()]);
    }

    public function saveRecords(UserRequest $request)
    {
        $record = $request->get('id') === null ? new User() : User::find($request->get('id'));
        $record->name = $request->get('name');
        $record->email = $request->get('email');
        $record->mobile_number = $request->get('mobile_number');
        $record->status = $request->get('status');
        $request->get('narrative') === null ? $record->narrative = '---' : $record->narrative = $request->get('narrative');
        $request->get('id') === null ? $record->created_by = session('id') : $record->updated_by = session('id');
        $record->save();
        return response()->json($record);
    }

    public function applyBulkOperation(Request $request)
    {
        $ids = explode(',', $request->get('ids'));
        foreach ($ids as $id) {
            User::where('id', $id)->update(['status' => $request->get('status')]);
        }
        return response()->json('Applying Bulk Operation Done Successfully');
    }

    public function getRecord(Request $request)
    {
        return response()->json(User::where('id', $request->get('id'))->first());
    }
}
