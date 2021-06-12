<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">Search</div>
        <form class="card-body" action="{{ route("searchByPosts") }}" method="GET">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Enter search term..." name="q" />
                <input class="btn btn-primary" id="button-search" type="submit" value="Go!">
{{--                <button class="btn btn-primary" id="button-search" type="button">Go!</button>--}}
            </div>
        </form>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                @if(count($categories) === 0)
                    <div class="col-sm-6">
                        No categories
                    </div>
                @else
                    @foreach($categories as $category)
                        @if($loop->first)
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                        @endif

                        @if($loop->last)
                            <li><a href="#!">{{ $category->name }}</a></li>
                                </ul>
                            </div>
                        @break
                        @endif

                        @if($loop->iteration % 3 === 0)
                            <li><a href="#!">{{ $category->name }}</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                        @else
                            <li><a href="#!">{{ $category->name }}</a></li>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
