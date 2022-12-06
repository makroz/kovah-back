<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Report;
use App\Event\ReportCreated;
use Illuminate\Http\Request;
use App\Jobs\CreateReportJob;
use Illuminate\Http\Response;
use App\Http\Requests\ReportCreateRequest;

class ReportController extends Controller
{
  public function index()
  {
    try {
      $reports = Report::select(['id', 'title', 'report_link', 'created_at'])->get();
      return response()->json($reports);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'errors' => [['message' => $e->getMessage()]]],);
    }
  }

  public function show($report_id)
  {
    try {
      $report = Report::find($report_id);
      return response()->json(['status' => 'ok', 'data' => $report]);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'errors' => [['message' => $e->getMessage()]]],);
    }
  }

  public function create(ReportCreateRequest $request)
  {
    try {
      $input = $request->all();
      $input['user_id'] = 1;
      $report = Report::create($input);
      event(new ReportCreated($report));
      return response()->json(['status' => 'ok', 'data' => $report]);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'errors' => [['message' => $e->getMessage()]]],);
    }
  }
}