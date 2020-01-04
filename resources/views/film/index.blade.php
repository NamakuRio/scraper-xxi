@extends('templates.master')

@section('css-page')
    <link rel="stylesheet" type="text/css" href="@asset('assets/css/tooltip.css')" />
@endsection

@section('content')
    <section id="film-list-section">
        <div class="row">
            <div class="col-12">
                <input type="text" name="title" class="form-control" placeholder="Cari Film..." onkeyup="searchFilm(this.value)">
            </div>
        </div>
        <hr>
        <div class="row match-height mt-2" id="film-list"></div>
        <div class="row my-1">
            <div class="loading-more col-12">
                <div class="text-center text-primary">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
            <div class="no-more-data col-12" style="display:none;">
                <div class="text-center text-primary">
                    <h4>Data sudah habis</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="detail-film-modal" tabindex="-1" role="dialog" aria-labelledby="detail-film-modal-center-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="detail-film-modal-center-title">Detail Film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="content-detail-film-modal"></div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-page')
    <script src="@asset('app-assets/js/scripts/tooltip/tooltip.js')"></script>
    <script src="@asset('assets/js/lazy-load.js')"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script> --}}
@endsection

@section('js-script')
    <script>
        var page = 1;
        var sendAjaxSearch = null;
        var searchPage = false;
        var searchQuery = "";
        var dataSearchQuery = true;
        var dataAll = true;

        $(function() {
            loadMoreData(page);
        });

        $(document).on("DOMNodeInserted", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

            if("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if(entry.isIntersecting){
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.original;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            } else {
                console.log("gagal load lazy");
            }
        });

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() > $(document).height() - 1){
                if(searchPage){
                    if(dataSearchQuery){
                        page++;
                        loadMoreDataSearch(page, searchQuery);
                    }
                } else {
                    if(dataAll){
                        page++;
                        loadMoreData(page);
                    }
                }
            }
        });

        function loadMoreData(page){
            $.ajax({
                url: "@route('film.getFilm')?page="+page,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function(){
                    $(".loading-more").show();
                    $(".no-more-data").hide();
                },
                complete: function(){
                    $(".loading-more").hide();
                },
                success: function(result) {
                    if(result.html == ""){
                        $(".no-more-data").show();
                        $(".no-more-data div h4").html("Data sudah habis");
                        dataAll = false;
	                    return;
                    }
                    $("#film-list").append(result.html);
                }
            });
        }

        function searchFilm(value)
        {
            if(value == ""){
                page = 1;
                loadMoreData(page);
                searchPage = false;
                $("#film-list div").remove();
                return false;
            }

            page = 1;
            searchQuery = value;
            dataSearchQuery = true;
            dataAll = true;
            searchPage = true;

            $("#film-list div").remove();

            if(sendAjaxSearch != null){
                sendAjaxSearch.abort();
            }

            sendAjaxSearch = $.ajax({
                url: "@route('film.search')",
                type: "POST",
                dataType: "json",
                data: {
                    "title": value,
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function(){
                    $(".loading-more").show();
                    $(".no-more-data").hide();
                },
                complete: function(){
                    $(".loading-more").hide();
                },
                success: function(result) {
                    $("#film-list div").remove();
                    if(result.html == ""){
                        $(".no-more-data").show();
                        $(".no-more-data div h4").html("Data yang Anda cari tidak tersedia");
                        return;
                    }
                    $("#film-list").append(result.html);
                }
            });
        }

        function loadMoreDataSearch(page, value){
            $.ajax({
                url: "@route('film.search')?page="+page,
                type: "POST",
                data: {
                    "title": value,
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function(){
                    $(".loading-more").show();
                    $(".no-more-data").hide();
                },
                complete: function(){
                    $(".loading-more").hide();
                },
                success: function(result) {
                    if(result.html == ""){
                        $(".no-more-data").show();
                        $(".no-more-data div h4").html("Data sudah habis");
                        dataSearchQuery = false;
	                    return;
                    }
                    $("#film-list").append(result.html);
                }
            });
        }

        function getDetailFilm(obj)
        {
            openModal();
            var slug = $(obj).data("slug");

            $.ajax({
                url: "@route('film.getDetailFilm')/"+slug,
                type: "POST",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(result) {
                    $("#detail-film-modal-center-title").text(result['title']);
                    $("#content-detail-film-modal").html(result['content']);
                }
            });
        }

        function openModal()
        {
            $("#detail-film-modal-center-title").text('Detail Film');
            $("#content-detail-film-modal").html(`<div class="loading-modal text-center text-primary my-2"><div class="spinner-border" role="status"></div></div>`);
            $("#detail-film-modal").modal("show");
        }

        function copyText(object)
        {
            var text = $(object).data('text');
            var copiedNow = false;

            var textArea = document.createElement( "textarea" );
            textArea.value = text;
            document.body.appendChild( textArea );

            textArea.select();

            try{
                var clipboard = document.execCommand('copy');

                $(object).attr('tooltip', 'Berhasil Disalin!');

                if(copiedNow){
                    clearTimeout(copiedNow);
                }

                copiedNow = setTimeout(() => {
                    $(object).attr('tooltip', 'Klik untuk menyalin!');
                }, 3000);
            }catch(err){
                console.log('Oops, unable to copy');
            }

            document.body.removeChild( textArea );
        }
    </script>
@endsection
