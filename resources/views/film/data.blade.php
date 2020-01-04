@foreach ($films as $key => $film)
<div class="col-xl-3 col-md-4 col-sm-6">
    <div class="card">
        <div class="card-content">
            <img class="lazy card-img-top img-fluid" src="@asset('uploads/film/picture/default.png')" data-original="{{ $film->picture }}" alt="{{ $film->title }}">
            <div class="card-body">
                @if (isset($title))
                    <h5 class="font-weight-bold">{!! str_ireplace($title, '<span class="bg-primary text-white">'.$title.'</span>', $film->title) !!}</h5>
                @else
                    <h5 class="font-weight-bold">{{ $film->title }}</h5>
                @endif
                {{-- <p class="card-text  mb-0">By Pixinvent Creative Studio</p>
                <span class="card-text">Elite Author</span> --}}
                <div class="card-btns d-flex justify-content-between mt-2">
                    <a href="javascript:void(0)" class="btn btn-block gradient-light-primary text-white" data-slug="{{ $film->slug }}" onclick="getDetailFilm(this)">Unduh</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach
