<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportCreateRequest;
use App\Jobs\CreateReportJob;
use App\Models\Report;
use Illuminate\Http\Request;

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

    $ReportJob = new CreateReportJob('prueba');
    $this->dispatch($ReportJob);
    return 'generate-report';
  }
}