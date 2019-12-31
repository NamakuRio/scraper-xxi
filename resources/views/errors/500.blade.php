@extends('templates.auth')

@section('css-page')
    <link rel="stylesheet" type="text/css" href="@asset('app-assets/css/pages/error.css')" />
@endsection

@section('content')
    <div class="content-header row"></div>
    <div class="content-body">
        <!-- error 500 -->
        <section class="row flexbox-container">
            <div class="col-xl-7 col-md-8 col-12 d-flex justify-content-center">
                <div class="card auth-card bg-transparent shadow-none rounded-0 mb-0 w-100">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <img src="@asset('app-assets/images/pages/500.png')" class="img-fluid align-self-center" alt="branding logo" />
                            <h1 class="font-large-2 mt-1 mb-0">Server Error!</h1>
                            <p class="p-3">Server sedang bermasalah, mohon lakukan beberapa saat lagi.</p>
                            <a class="btn btn-primary btn-lg" href="@route('main')">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- error 500 end -->
    </div>
@endsection
