@extends('templates.master-1-column')

@section('css-vendor')
    <link rel="stylesheet" type="text/css" href="@asset('app-assets/vendors/css/tables/datatable/datatables.min.css')">
@endsection

@section('content')
    <!-- List Film -->
    <section id="list-film-section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Film</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                {{-- <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li> --}}
                                {{-- <li><a data-action="close"><i class="feather icon-x"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="list-film-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Foto</th>
                                            <th>Video</th>
                                            <th>Subtitle</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Foto</th>
                                            <th>Video</th>
                                            <th>Subtitle</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ List Film -->
@endsection

@section('js-vendor')
    <script src="@asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')"></script>
    <script src="@asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')"></script>
    <script src="@asset('app-assets/vendors/js/tables/datatable/datatables.min.js')"></script>
    <script src="@asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')"></script>
    <script src="@asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')"></script>
    <script src="@asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')"></script>
    <script src="@asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')"></script>
    <script src="@asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')"></script>
@endsection

@section('js-script')
    <script>
        $(function() {
            getFilms();
        });

        async function getFilms()
        {
            $("#list-film-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "@route('film.get')",
                destroy: true,
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'title' },
                    { data: 'picture' },
                    { data: 'film' },
                    { data: 'subtitle' },
                    { data: 'action' },
                ]
            });
        }
    </script>
@endsection
