<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;

class ReportController extends Controller
{
    public function create()
    {
        return view('report.create');
    }

    public function post(Request $request)
    {
        $report = new Report();

        $report->user_id = Auth::user()->id;
        $report->type = $request->get('type');
        $report->message = strip_tags(nl2br($request->get('message')),'<br>');
        $report->ip = $request->ip();
        $report->version = config('app.version');
        $report->save();

        Toastr::success('Rapport envoyé');
        return redirect(route('home'));
    }

    public function index()
    {
        $reports = Report::all();

        return view('report.index', compact('reports'));
    }

    public function seen($report_id)
    {
        $report = Report::find($report_id);
        $report->seen = !$report->seen;
        $report->save();

        return redirect(route('report.index'));
    }

    public function show($report_id)
    {
        $report = Report::find($report_id);

        return view('report.show', compact('report'));
    }

    public function complete(Report $report)
    {
        $report->status = !$report->status;
        $report->save();

        return redirect(route('report.index'));
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect(route('report.index'));
    }
}
