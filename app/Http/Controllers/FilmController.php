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
        $films = Film::paginate(10);
        $films->load('filmFiles', 'filmSubtitles');
        $view = view('film.data', compact('films'))->render();

        return response()->json(['html' => $view]);
    }

    public function searchFilm(Request $request)
    {
        $title = $request->title;

        $films = Film::where('title', 'LIKE', '%'.$title.'%')->paginate(10);
        $films->load('filmFiles', 'filmSubtitles');
        $view = view('film.data', compact('films', 'title'))->render();

        return response()->json(['html' => $view]);
    }

    public function getDetailFilm(Film $film)
    {
        if(!$film){
            return response()->json(['status' => 'error', 'title' => 'Film tidak ditemukan', 'content' => 'Film yang Anda cari tidak ditemukan']);
        }

        $view = view('film.detail', compact('film'))->render();

        return response()->json(['status' => 'success', 'title' => $film->title, 'content' => $view]);
    }
}
