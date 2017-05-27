@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="editor-container">
                        <h1>Title</h1>
                        <p>Write your story...</p>
                    </div>
                </div>
            </div>
            <div id="saveStatus"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.4/quill.snow.css">
<link rel="stylesheet" href="{{ asset('css/plugins/highlight/androidstudio.css') }}">
@endpush

@push('endscripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.11.0/highlight.min.js"></script>
<script src="{{ asset('js/plugins/quill.js') }}"></script>
<script src="{{ asset('js/plugins/image-resize.min.js') }}"></script>
<script src="{{ asset('js/plugins/notify.min.js') }}"></script>
<script>
// quilljs upload image
var imageHandler = function(image, callback) {
    var data = new FormData();
    data.append('image', image);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('upload') }}', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 200 && response.success) {
                callback(response.data.link);
            } else {
                var reader = new FileReader();
                reader.onload = function(e) {
                    callback(e.target.result);
                };
                reader.readAsDataURL(image);
            }
        }
    }
    xhr.send(data);
}

// highlight
hljs.configure({
    languages: ['php', 'javascript', 'ruby', 'python']
});

// quilljs
var Delta = Quill.import('delta');
var quill = new Quill('#editor-container', {
    theme: 'snow',
    placeholder: 'Start your story...',
    modules: {
        syntax: true,
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            ['link', 'blockquote', 'image', 'code-block']
        ],
        imageResize: {}
    },
    imageHandler: imageHandler
});

// Store accumulated changes
var change = new Delta();
var saveTimeout;

// Check for unsaved data
window.onbeforeunload = function() {
    if (change.length() > 0) {
        return 'There are unsaved changes. Are you sure you want to leave?';
    }
}

$(document).ready(function(){
    var title = $('#editor-container').find('h1').first();
    var saveStatus = $('#saveStatus');
    var blogId = 0;
    var self = $(this);

    quill.on('text-change', function(delta) {
        change = change.compose(delta);
        clearTimeout(saveTimeout);

        if (change.length() > 0) {
            saveTimeout = setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: '{{ route('store') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: blogId,
                        title: title.length ? title.text() : "",
                        content: JSON.stringify(quill.getContents())
                    },
                    dataType: 'json',
                    success: function(response) {
                        blogId = response.id;
                        $.notify("Saved successfully.", {
                            className: 'success',
                            globalPosition: 'bottom left',
                        });
                    }
                });
            }, 2000);

            change = new Delta();
        }
    });
});
</script>
@endpush
