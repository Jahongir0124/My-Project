<?php

namespace App\Http\Controllers\Admin;

use App\Services\ShiftService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shift;


class ShiftController extends Controller
{
    

    public function __construct(protected readonly ShiftService $shiftService){}
    public function index()
    {
        return view('admin.shifts', [
            'shifts' => $this->shiftService->index()
        ]);
    }

    public function store(Request $request)
    {
        
        $shift = $this->shiftService->store($request);
        return response()->json([
            'msg' => 'Created Succesfully',
            'data' => $shift
        ]);
    }

    public function destroy(Shift $shift)
    {
        $this->shiftService->destroy($shift);
        return redirect()->back()->with('succses', 'Deleted');
    }

    public function shift_pairs(Request $request)
    {
        $data = $this->shiftService->usedShifts($request);
        return response()->json($data);
    }
}
