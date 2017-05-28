@extends ('layouts.default')

@section ('content')

<div class="top-right links">
    <a href="{{ Route('admin') }}">Admin</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <section class="quill-render spacer">
                <div class="spacer"></div>
                @foreach ($blogs as $blog)
                <div class="text-muted">
                    Published {{ Carbon::parse($blog->published_at)->diffForHumans() }}
                </div>
                <div class="text-muted mb30">
                    By <span class="text-primary">{{ $blog->user->name }}</span>
                </div>
                {!! $blog->content !!}
                @if ($loop->remaining > 0)
                <hr class="large" />
                @endif
                @endforeach
            </section>

            @if (count($blogs) <= 0)
            <div class="large-spacer"></div>
            <div class="text-center">
                <img src="{{ asset('image/empty.jpg') }}" height="150px" class="mb30" />
                <h2>Idea is everywhere.</h2>
            </div>
            @endif

            @include ('includes.foot')
        </div>
    </div>
</div>

@endsection

@push ('endscripts')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
</script>
@endpush
