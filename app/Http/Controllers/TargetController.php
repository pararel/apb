<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    public function showTarget()
    {
        $targets = Target::where('id_acc', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('user.target', compact('targets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:a,b,c,d,e,f,g,h,i,j,k,l,m',
            'parameter' => 'required|string|in:power,cost',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'value' => 'required|numeric|min:0.01',
        ]);

        $type = $request->type;
        $parameter = $request->parameter;
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $value = $request->value;
        $days = $start->diffInDays($end) + 1;
        $typeValue = $this->getTypeValue($type);

        if ($parameter === 'power') {
            $average = $value / $days;
        } else {
            $average = $value / ($typeValue * $days);
            $value = $value / $typeValue;
        }
        $value = round($value, 2);
        $average = round($average, 2);
        $target = new Target();
        $target->type = $this->getTypeText($type);
        $target->parameter = $parameter;
        $target->start = $start;
        $target->end = $end;
        $target->days = $days;
        $target->value = $value;
        $target->average = $average;
        $target->usage = 0;
        $target->countDays = 0;
        $target->id_acc = Auth::id();
        $target->save();

        $user = Auth::user();
        $user->incrementCurrentTargets();
        $user->incrementAllTargets();

        History::create([
            'message' => 'Target #' . $target->id . ' berhasil dibuat.',
            'info' => 'target',
            'id_acc' => Auth::id(),
        ]);
        return redirect()->route('target')->with('success', 'Target created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usage' => 'required|numeric|min:0.01',
        ]);

        $target = Target::findOrFail($id);
        $target->usage = round($target->usage + $request->usage, 2);
        $target->countDays += 1;
        $target->save();
        History::create([
            'message' => 'Anda menginput progres sebanyak ' . $request->usage . ' kWh untuk hari ke-' . $target->countDays . " pada Target #" . $target->id,
            'info' => 'target',
            'id_acc' => Auth::id(),
        ]);

        return redirect()->route('target')->with('success', 'Target updated successfully.');
    }

    public function destroy($id)
    {
        $target = Target::findOrFail($id);
        History::create([
            'message' => 'Anda menghapus Target #' . $target->id,
            'info' => 'target',
            'id_acc' => Auth::id(),
        ]);
        $target->delete();
        $user = Auth::user();
        $user->decrementCurrentTargets();
        return redirect()->route('target')->with('success', 'Target deleted successfully.');
    }

    private function getTypeValue($type)
    {
        switch ($type) {
            case 'a':
                return 1352;
            case 'b':
                return 1444.7;
            case 'c':
                return 1444.7;
            case 'd':
                return 1699.53;
            case 'e':
                return 1699.53;
            case 'f':
                return 1444.7;
            case 'g':
                return 1114.74;
            case 'h':
                return 1114.74;
            case 'i':
                return 996.74;
            case 'j':
                return 1699.53;
            case 'k':
                return 1522.88;
            case 'l':
                return 1699.53;
            case 'm':
                return 1644.52;
        }
    }

    private function getTypeText($type)
    {
        switch ($type) {
            case 'a':
                return 'R-1/ TR daya 900 VA';
            case 'b':
                return 'R-1/ TR daya 1.300 VA';
            case 'c':
                return 'R-1/ TR daya 2.200 VA';
            case 'd':
                return 'R-2/ TR daya 3.500-5.500 VA';
            case 'e':
                return 'R-3/ TR daya 6.600 VA ke atas';
            case 'f':
                return 'B-2/ TR daya 6.600 VA-200 kVA';
            case 'g':
                return 'B-3/ Tegangan Menengah (TM) daya di atas 200 kVA';
            case 'h':
                return 'I-3/ TM daya di atas 200 kVA';
            case 'i':
                return 'I-4/ Tegangan Tinggi (TT) daya 30.000 kVA ke atas';
            case 'j':
                return 'P-1/ TR daya 6.600 VA-200 kVA';
            case 'k':
                return 'P-2/ TM daya di atas 200 kVA';
            case 'l':
                return 'P-3/ TR untuk penerangan jalan umum';
            case 'm':
                return 'L/ TR, TM, TT';
        }
    }
}