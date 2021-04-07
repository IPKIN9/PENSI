<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Model\GenerationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GenerationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Landing.InputGeneration');
    }

    public function ajax(Request $request)
    {
        $listProfile = GenerationModel::all();
        if ($request->ajax()) {
            return DataTables::of($listProfile)
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('Y-m-d'); // human readable format
                })
                ->editColumn('updated_at', function ($request) {
                    return $request->updated_at->format('Y-m-d'); // human readable format
                })
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm author-restore"><i class="fas fa-trash-restore"></i> Restore</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="author-delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Permanent Deleting</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'generation' => 'required|string|unique:generations',
            'years' => 'required|string',
        ]);

        $data = array([
            'generation' => $request->input('generation'),
            'years' => $request->input('years'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('generations')->insert($data);
        return redirect(route('generation.index'))->with('status', 'Saving Success');
    }
}
