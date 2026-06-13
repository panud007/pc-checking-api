<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DiagnosticReport;

class DiagnosticReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = DiagnosticReport::latest();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('ticket_id', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('technician_name', 'like', "%{$search}%")
                  ->orWhere('device_model', 'like', "%{$search}%");
            });
        }
        
        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|string',
            'technician_name' => 'required|string',
            'customer_name' => 'required|string',
            'device_model' => 'required|string',
            'specs' => 'required|array',
            'test_results' => 'required|array',
            'notes' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $report = DiagnosticReport::updateOrCreate(
            ['ticket_id' => $validated['ticket_id']],
            $validated
        );

        return response()->json([
            'message' => 'Report saved successfully.',
            'data' => $report
        ], 200);
    }

    public function show($ticket_id)
    {
        $report = DiagnosticReport::where('ticket_id', $ticket_id)->first();

        if (!$report) {
            return response()->json(['message' => 'Report not found.'], 404);
        }

        return response()->json($report, 200);
    }

    public function destroy($ticket_id)
    {
        $report = DiagnosticReport::where('ticket_id', $ticket_id)->first();

        if (!$report) {
            return response()->json(['message' => 'Report not found.'], 404);
        }

        $report->delete();

        return response()->json(['message' => 'Report deleted successfully.'], 200);
    }
}
