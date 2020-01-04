<div class="row">
    <div class="col-md-3">
        <img class="lazy img-fluid" src="@asset('uploads/film/picture/default.png')" data-original="{{ $film->picture }}" alt="{{ $film->title }}">
    </div>
    <div class="col-md-9">
        <fieldset>
            <label class="font-weight-bold" for="detail-title">Judul</label>
            <p class="form-control-static" id="detail-title" style="padding-left:0.2rem">{{ $film->title }}</p>
        </fieldset>
        <fieldset>
            <label class="font-weight-bold" for="detail-subtitle">Subtitle</label>
            <p class="form-control-static" id="detail-subtitle" style="padding-left:0.2rem">
                {{-- <span tooltip="Klik untuk menyalin!" data-text="{{ $film->subtitle }}" onclick="copyText(this)" style="cursor:pointer;"> --}}
                    {{ $film->subtitle }}
                {{-- </span>  --}}
                <a href="{{ $film->subtitle }}" target="_blank" tooltip="Buka di tab baru"><i class="feather icon-external-link"></i></a></p>
        </fieldset>
        <fieldset>
            <label class="font-weight-bold" for="detail-get-data">Data didapatkan</label>
            <p class="form-control-static" id="detail-get-data" style="padding-left:0.2rem">{{ \Carbon\Carbon::parse($film->created_at)->diffForHumans() }}</p>
        </fieldset>
    </div>
</div>
<div class="row mt-1">
    <div class="col-12">
        <fieldset>
            <label class="font-weight-bold">Subtitle Lainnya</label>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Label</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($film->filmSubtitles->count() == 0)
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h4>Tidak ada Subtitle</h4>
                                </td>
                            </tr>
                        @endif
                        @foreach ($film->filmSubtitles as $key => $filmSubtitle)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $filmSubtitle->label }}</td>
                                <td>
                                    <a href="{{ $filmSubtitle->file }}" target="_blank">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
    <div class="col-12">
        <fieldset>
            <label class="font-weight-bold">File</label>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kualitas</th>
                            <th>Google Drive ID</th>
                            <th>Google Drive Link</th>
                            {{-- <th>File</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if ($film->filmFiles->count() == 0)
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h4>Tidak ada Film</h4>
                                </td>
                            </tr>
                        @endif
                        @foreach ($film->filmFiles as $key => $filmFile)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ strtoupper($filmFile->quality) }}</td>
                                <td>
                                    {{-- <span tooltip="Klik untuk menyalin!" data-text="{{ $filmFile->google_drive_id }}" onclick="copyText(this)" style="cursor:pointer">Salin</span> --}}
                                    {{ $filmFile->google_drive_id }}
                                </td>
                                <td>
                                    {{-- <span tooltip="Klik untuk menyalin!" data-text="{{ $filmFile->google_drive_link }}" onclick="copyText(this)" style="cursor:pointer">Salin</span> |  --}}
                                    <a href="{{ $filmFile->google_drive_link }}" target="_blank" tooltip="Buka di tab baru">Buka <i class="feather icon-external-link"></i></a>
                                </td>
                                {{-- <td>
                                    <a href="{{ $filmFile->link }}" target="_blank" tooltip="Buka di tab baru">Buka <i class="feather icon-external-link"></i></a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</div>
