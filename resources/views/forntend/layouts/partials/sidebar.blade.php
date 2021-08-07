<div class="col-md-3 col-md-offset-1">
    <div class="sidebar hidden-sm hidden-xs">
        <div class="widget">
            <h6 class="upper">Search blog</h6>

            <form action="{{ route('post.search') }}" method="POST">
                @csrf
                <input name="search" type="text" placeholder="Search.." class="form-control">
            </form>

        </div>
        <!-- end of widget        -->
        <div class="widget">
            <h6 class="upper">Categories</h6>
            <ul class="nav">

                @php
                    $all_categories = \App\Models\Category::where('status',true)->get();
                    $all_tags = \App\Models\Tag::where('status',true)->get();
                    $all_latest_post = \App\Models\Post::where('status',true)->take(5)->latest()->get();
                @endphp
                @foreach($all_categories as $category)
                    <li><a href="{{ route('post.cat.search', $category->slug) }}" >{{ $category->name }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
        <!-- end of widget        -->
        <div class="widget">
            <h6 class="upper">Popular Tags</h6>
            <div class="tags clearfix">
                @foreach($all_tags as $tags)
                    <a href="{{ route('post.tag.search', $tags->slug) }}">{{ $tags->name }}</a>
                @endforeach
            </div>
        </div>
        <!-- end of widget      -->
        <div class="widget">
            <h6 class="upper">Latest Posts</h6>
            <ul class="nav">

                @foreach($all_latest_post as $post)
                    <li><a href="{{ $post->id }}">{{ $post->title }}<i class="ti-arrow-right"></i><span>{{ $post->created_at->format('F d, Y') }}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- end of widget          -->
    </div>
    <!-- end of sidebar-->
</div>
