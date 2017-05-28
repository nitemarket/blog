@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Your stories</h2>
            @foreach ($blogs as $blog)
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        @if (isset($blog->published) && $blog->published)
                        <span class="label label-success left">Public</span>
                        @else
                        <span class="label label-default left">Draft</span>
                        @endif

                        @if (strtolower($blog->title) == 'title')
                        Untitled story
                        @else
                        {{ $blog->title }}
                        @endif
                    </h4>
                    <br/>
                    <div>
                        <div class="text-muted pull-left">
                            Updated {{ Carbon::parse($blog->updated_at)->diffForHumans() }}
                        </div>
                        <div class="pull-right">
                            <form method="post" action="{{ route('blogs.destroy', ['id' => $blog->_id]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <div class="btn-group" role="group" aria-label="blog-actions">
                                    <a href="{{ route('blogs.edit', ['id' => $blog->_id]) }}" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if (count($blogs) <= 0)
            <div class="panel panel-default">
                <div class="panel-body">
                    You do not have story yet. <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-xs">Create now.</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
