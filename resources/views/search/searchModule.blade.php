<div class="searchModule">
    <form class="searchElements">
            <input id="searchBox" type="text" placeholder="Search by Scientific, Common, or Myaamia name" style="width: 375px;">
            <button id="searchBtn" type="submit"><i class="fa fa-search" aria-hidden="true" style="color:white";></i></button>
            <script>
                $( document ).ready(function() {
                    $('#searchBtn').click(function(e) {
                        e.preventDefault();
                        var q = $('#searchBox').val();
                        if(!q) return;
                        loading();
                        window.location.href = "{{route('search.result')}}?q=" + q;
                    });
                });
            </script>
            {{--<a class="btn btn-outline-success my-2 my-sm-0" href="{{route('search.index')}}" style="margin-left: 8px;">Advanced Search</a>--}}
        </form>
        <a href="{{route('species.index')}}"><button id="browseBtn" type="submit">Browse</button></a>
       <a href="{{route('search.index')}}"><button id="advancedSearchBtn" type="submit">Advanced Search</button></a>
</div>