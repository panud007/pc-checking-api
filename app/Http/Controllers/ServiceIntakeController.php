<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceIntake;

class ServiceIntakeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = ServiceIntake::latest();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('no_nota', 'like', "%{$search}%")
                  ->orWhere('nama_pelanggan', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('tipe_perangkat', 'like', "%{$search}%");
            });
        }
        
        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_nota' => 'required|string',
            'nama_pelanggan' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'tipe_perangkat' => 'nullable|string',
            'device_type' => 'nullable|string',
            'tanggal_masuk' => 'nullable|date',
            'processor' => 'nullable|string',
            'gpu' => 'nullable|string',
            'ram' => 'nullable|string',
            'storage' => 'nullable|string',
            'components' => 'nullable|array',
            'service_types' => 'nullable|array',
            'kerusakan_inti' => 'nullable|string',
        ]);

        $intake = ServiceIntake::updateOrCreate(
            ['no_nota' => $validated['no_nota']],
            $validated
        );

        return response()->json([
            'message' => 'Intake saved successfully.',
            'data' => $intake
        ], 200);
    }

    public function show($no_nota)
    {
        $intake = ServiceIntake::where('no_nota', $no_nota)->first();
        
        if (!$intake) {
            return response()->json(['message' => 'Intake not found.'], 404);
        }
        
        return response()->json($intake, 200);
    }

    public function destroy($no_nota)
    {
        $intake = ServiceIntake::where('no_nota', $no_nota)->first();
        
        if (!$intake) {
            return response()->json(['message' => 'Intake not found.'], 404);
        }
        
        $intake->delete();
        
        return response()->json(['message' => 'Intake deleted successfully.'], 200);
    }
}
