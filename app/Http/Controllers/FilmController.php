<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FilmController extends Controller
{
    public function index()
    {
        return view('film.index');
    }

    public function getFilm()
    {
        $films = Film::all();

        return DataTables::of($films)
            ->editColumn('picture', function ($film) {
                return $film->picture();
            })
            ->addColumn('film', function ($film) {
                $file = "";

                $file .= '<a href="javascript:void(0)" class="text-center">'.$film->filmFiles->count().' Video</a>';
                return $file;
            })
            ->addColumn('subtitle', function ($film) {
                $subtitle = "";

                $subtitle .= '<a href="javascript:void(0)" class="text-center">'.$film->filmSubtitles->count().' Subtitle</a>';
                return $subtitle;
            })
            ->addColumn('action', function ($film) {
                $action = "";

                $action .= '<button type="button" class="btn btn-icon rounded-circle bg-gradient-success mr-1 mb-1"><i class="feather icon-search"></i></button>';
                return $action;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);

        // return $datatables;
    }
}
