<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Jobs\CreateReportJob;
use Illuminate\Http\Response;
use App\Http\Requests\ReportCreateRequest;

class ReportController extends Controller
{
  public function index(Request $request)
  {
    return 'list-reports';
    $reports = Report::all();
    return response()->json($reports);
  }

  public function show(Request $request, $report_id)
  {
    return 'get-report ' . $report_id;
  }
  public function create(ReportCreateRequest $request)
  {
    try {
      $input = $request->all();
      $input['user_id'] = 1;
      $report = Report::create($input);
      $ReportJob = new CreateReportJob($report);
      $this->dispatch($ReportJob);
      return response()->json(['status' => 'ok', 'data' => $report]);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'errors' => [['message' => $e->getMessage()]]],);
    }
  }
}