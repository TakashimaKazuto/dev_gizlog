<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    protected $daily_report;

    public function __construct(DailyReport $daily_report)
    {
        $this->middleware('auth');
        $this->daily_report = $daily_report;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if(empty($input)){
            $daily_reports = $this->daily_report->all();
        } else {
            $daily_reports = $this->daily_report->getSearchResult($input);
        }

        return view('user.daily_report.index', compact('daily_reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();

        return view('user.daily_report.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyReportRequest $request)
    {
        $input = $request->all();
        $this->daily_report->create($input);

        return redirect()->route('daily_report.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daily_report = $this->daily_report->find($id);

        return view('user.daily_report.show', compact('daily_report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daily_report = $this->daily_report->find($id);

        return view('user.daily_report.edit', compact('daily_report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DailyReportRequest $request, $id)
    {
        $daily_report = $this->daily_report->find($id);
        $input = $request->all();
        $this->daily_report->updateDailyReport($input, $daily_report);

        return redirect()->route('daily_report.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->daily_report->find($id)->delete();

        return redirect()->route('daily_report.index');
    }
}
