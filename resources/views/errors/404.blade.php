@extends('templates.auth')

@section('css-page')
    <link rel="stylesheet" type="text/css" href="@asset('app-assets/css/pages/error.css')" />
@endsection

@section('content')
    <div class="content-header row"></div>
    <div class="content-body">
        <!-- error 404 -->
        <section class="row flexbox-container">
            <div class="col-xl-7 col-md-8 col-12 d-flex justify-content-center">
                <div class="card auth-card bg-transparent shadow-none rounded-0 mb-0 w-100">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <img src="@asset('app-assets/images/pages/404.png')" class="img-fluid align-self-center" alt="branding logo" />
                            <h1 class="font-large-2 my-1">404 - Halaman tidak ditemukan!</h1>
                            <p class="p-2">Halaman yang Anda cari tidak ditemukan, Anda mungkin salah memasukkan url atau halaman sudah dihapus oleh pemilik.</p>
                            <a class="btn btn-primary btn-lg mt-2" href="@route('main')">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- error 404 end -->
    </div>
@endsection
