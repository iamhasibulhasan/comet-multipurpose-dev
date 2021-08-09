@extends('forntend.layouts.app')
@section('blog-title', $single_post->title)

@foreach($single_post->categories as $cat)
    @section('blog-cat', $cat->name)
@endforeach

@section('main-content')
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <article class="post-single">
              <div class="post-info">
                <h2><a href="#">{{ $single_post->title }}</a></h2>
                  <h6 class="upper"><span>By</span><a href="{{ $single_post->user_id }}"> {{ $single_post->user->name }}</a><span class="dot"></span><span>{{ $single_post->created_at->format('F d, Y') }}</span><span class="dot"></span>
                      @foreach($single_post->tags as $tag)
                          <a href="{{ route('post.tag.search', $tag->slug) }}" class="post-tag">{{ $tag->name }}</a>.
                      @endforeach
                  </h6>
              </div>
                  @php
                      $featured = json_decode( $single_post->featured );
                  @endphp
                @if($featured->post_type == 'Image')
                    <div class="post-media">
                        <a href="#">
                            <img src="{{ URL::to('') }}/media/posts/{{ $featured->post_image }}" alt="">
                        </a>
                    </div>
                @endif
                @if($featured->post_type == 'Gallery')
                    <div class="post-media">
                        <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                            <ul class="slides">
                                @foreach($featured->post_gallery as $gallery)
                                    <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0.100158; display: block; z-index: 2;">
                                        <img src="{{ URL::to('') }}/media/posts/{{ $gallery }}" alt="" draggable="false">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if($featured->post_type == 'Video')
                    <div class="post-media">
                        <div class="media-video">
                            <iframe src="{{ $featured->post_video }}" frameborder="0"></iframe>
                        </div>
                    </div>
                @endif
              <div class="post-body">

                  {!! htmlspecialchars_decode($single_post->content) !!}

              </div>
            </article>
            <!-- end of article-->


            <div id="comments">
              <h5 class="upper">{{ $single_post->comments->count() }} Comments</h5>
              <ul class="comments-list">
                @foreach($single_post->comments as $comment)
                    @if($comment->comment_id == null)
                        <li>
                          <div class="comment">
                            <div class="comment-pic">
                              <img src="{{ URL::to('forntend/images/team/1.jpg') }}" alt="" class="img-circle">
                            </div>
                            <div class="comment-text">
                              <h5 class="upper">{{ $comment->user->name }}</h5><span class="comment-date">Posted on
                                    {{ date('d F,Y', strtotime($comment->created_at)) }} at
                                    {{ date('g:i', strtotime($comment->created_at)) }}</span>
                              <p>{{ $comment->text }}</p>

                                @guest
                                    <p>Please <a href="{{ route('admin.login') }}">login</a> first for reply.</p>
                                @else
                                    <a href="#" class="comment-reply comment_reply_btn" c_id="{{ $comment->id }}" >Reply</a>
                                    <div class="reply-box reply-box-{{ $comment->id }}">
                                        <form action="{{ route('blog.post.reply') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input name="post_id" type="hidden" class="form-control" value="{{ $single_post->id }}">
                                                <input name="comment_id" type="hidden" class="form-control" value="{{ $comment->id }}">
                                                <textarea name="reply_text" placeholder="Comment" class="form-control"></textarea>
                                            </div>
                                            <div class="form-submit text-right">
                                                <button type="submit" class="btn btn-color-out">Replay</button>
                                            </div>
                                        </form>
                                    </div>
                                @endguest

                            </div>
                          </div>
                            @php
                                $replies = App\Models\Comment::where('comment_id', '!=', null )-> where('comment_id', $comment->id)->get();
                            @endphp
                        @foreach($replies as $reply)
                          <ul class="children">
                            <li>
                              <div class="comment">
                                <div class="comment-pic">
                                  <img src="forntend/images/team/2.jpg" alt="" class="img-circle">
                                </div>
                                <div class="comment-text">
                                  <h5 class="upper">{{ $reply->user->name }}</h5><span class="comment-date">Posted on
                                    {{ date('d F,Y', strtotime($reply->created_at)) }} at
                                    {{ date('g:i', strtotime($reply->created_at)) }}</span>
                                  <p>{{ $reply->text }}</p>
                                </div>
                              </div>
                            </li>
                          </ul>
                        @endforeach
                        </li>
                      @endif
               @endforeach

              </ul>
            </div>
            <!-- end of comments-->

              @guest
                <p>Please <a href="{{ route('admin.login') }}">login</a> first before leave a comment.</p>
              @else
                <div id="respond">
                  <h5 class="upper">Leave a comment</h5>
                  <div class="comment-respond">
                    <form class="comment-form" action="{{ route('blog.post.comment') }}" method="POST">
                        @csrf
                      <div class="form-double">
{{--                        <div class="form-group">--}}
{{--                          <input name="author" type="text" placeholder="Name" class="form-control">--}}
{{--                        </div>--}}
{{--                        <div class="form-group last">--}}
{{--                          <input name="email" type="text" placeholder="Email" class="form-control">--}}
{{--                        </div>--}}
                      </div>
                      <div class="form-group">
                          <input name="post_id" type="hidden" class="form-control" value="{{ $single_post->id }}">
                        <textarea name="comments" placeholder="Comment" class="form-control"></textarea>
                      </div>
                      <div class="form-submit text-right">
                        <button type="submit" class="btn btn-color-out">Post Comment</button>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- end of comment form-->
              @endguest


          </div>
            @include('forntend.layouts.partials.sidebar')
        </div>
        <!-- end of row-->
      </div>
    </section>
@endsection
