@extends('app')
@section('content')
    <div class="content blog-container">
        <div class="row">
            <div class="col-md-12">
                @if ( ! empty($data['blogs']))
                    @foreach($data['blogs'] as $blog)
                        <div class="notes-container" id="{{ str_replace(' ','-',$blog->id) }}">
                            <p><strong>{{$blog->title}}</strong> </p>
                            <div class="notes-text"><p>{{str_replace("<br />","\n",nl2br($blog->post))}}</p></div>
                                <div class="notes-footer">
                                    <div class="added-date pull-left"><span class="added-date"> <strong>Added By: </strong>{{$blog->name}} at {{date('h:i A',strtotime($blog->created_at))}} on {{date('d/m/Y', strtotime($blog->created_at))}}</span></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                    @endforeach
                @else
                    <em>No blogs exist.</em>
                @endif
            </div>
        </div>    
    </div>
    <script src={{ URL::asset('js/chosen.jquery.min.js')}}>
    </script>
@stop