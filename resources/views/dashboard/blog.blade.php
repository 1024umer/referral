@extends('layouts.main')
@section('content')
    <section class="small-banner blogg">
        <div class="container">
            <div class="bannerr-text" data-aos="zoom-in" data-aos-duration="1500">
                <h4 class="pink">Recent Publications</h4>
                <h3>Our Latest Blogs</h3>
                <p>Dive into blogs section where our AI experts share their knowledge, practical tips, and industry trends.
                    Stay updated with the latest advancements and explore diverse perspectives on AI applications.</p>
            </div>
        </div>
    </section>


    <section class="blogs-search-bar">
        <div class="container">
            <div class="search-barr">
                <form action="{{ route('blogs.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="blog_search" class="form-control"
                            placeholder="Search your favorite blogs here" aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
            </div>
            <div class="normal-links">
                <div class="cate-main">
                    @foreach ($categoriesAll as $category)
                        <div class="item">
                            <a
                                href="{{ route('blogs.categories', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="latest-blogs">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-4">
                        <a href="{{ route('blog-inner', $blog->slug) }}">
                            <div class="blogs-slides" data-aos="zoom-in" data-aos-duration="1000">
                                @if($blog->image)
                                    <div class="blogs-img">
                                        <img src="{{ $blog->image->full_url }}">
                                    </div>
                                @endif
                                <div class="blogs-content">
                                    <h5 class="green">{{ $blog->title }}</h5>
                                    <p>{{ $blog->description }}</p>
                                    <div class="blogs-btn">
                                        @foreach ($blog->categories as $category)
                                            <a href="#">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="blogs-slides-bottom">
                                    <ul>
                                        <li><i class="fa-solid fa-calendar"></i>{{ $blog->created_at->format('Y-m-d') }}
                                        </li>
                                        |<li class="pink"><i class="fa-solid fa-share-nodes"></i><a
                                                href="javascript:void(0);" class="share-link"
                                                data-url="{{ route('blog-inner', $blog->slug) }}">Share</a></li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareLinks = document.querySelectorAll('.share-link');
            console.log("here");
            shareLinks.forEach(function(shareLink) {
                shareLink.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    const input = document.createElement('input');
                    input.value = url;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    alert('Link copied to clipboard: ' + url);
                });
            });
        });
    </script>
@endpush
