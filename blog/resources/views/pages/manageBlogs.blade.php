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
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-orange dropdown-toggle btn-xs" type="button" id="dropdownMenu1" data-toggle="dropdown">Manage Blog <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                <li><a tabindex="-1" href="#" class="manage-blog" id="edit-{{$blog->id}}" data-blog-title="{{ $blog->title }}" data-blog-post="{{ $blog->post }}">Edit </a></li>
                                                <li><a tabindex="-1" href="#" class="manage-blog" id="delete-{{$blog->id}}">Delete</a></li>
                                            </ul>
                                    </div>
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
    
    <script>
    $(document).ready(function () {
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
        });
  
    $('.manage-blog').click(function () {
            var id = $(this).prop('id');
            var split_id = id.split("-");
            var action = split_id[0];
            var sData = {};
            sData['blogID'] = split_id[1];
            
            var blogPost = $(this).data('blog-post');

            if (action == 'edit') {
                bootbox.dialog({
                            title: "Edit Blog",
                            message: '<div class="row">  ' +
                            '<div class="col-md-12"> ' +
                            '<form> ' +
                            '<div class="row"> ' +
                            '    <label for="post" class="col-md-2">Blog Content</label> ' +
                            '    <div class="col-md-10"> ' +
                            '        <div class="form-group"> ' +
                            '            <textarea name="post" id="updated-post" class="form-control" cols="50" rows="5" id="post">' + blogPost + ' </textarea> ' +
                            '        </div> ' +
                            '    </div> ' +
                            '</div> ' +
                            '</form> </div>  </div>',
                            buttons: {
                                close: {
                                    label: "Close",
                                    className: "btn-grey"
                                },
                                success: {
                                    label: "Save",
                                    className: "btn-teal",
                                    type: "submit",
                                    callback: function () {
                                        sData['post'] = $('#updated-post').val();
                                        $.ajax
                                        ({
                                            type: 'POST',
                                            url: "{{ URL::to('sportsmed/updateblog')}}",
                                            data: sData,
                                            success: function () {
                                                location.reload();
                                            },
                                            error: function () {
                                                alert('There was an error in updating.')
                                            }
                                        });
                                    }
                                }
                            }
                        }
                );
            }
            else if (action == 'delete') {
                bootbox.dialog({
                    message: "Are you sure you want to delete this blog post?",
                    title: "Delete Blog Post",
                    callback: function (result) {
                    },
                    buttons: {
                        close: {
                            label: "Close",
                            className: "btn-grey"
                        },
                        success: {
                            label: "Delete",
                            className: "btn-teal",
                            callback: function () {
                                $.ajax
                                ({
                                    type: 'POST',
                                    url: "{{ URL::to('sportsmed/deleteblog')}}",
                                    data: sData,
                                    success: function () {
                                        location.reload();
                                    },
                                    error: function () {
                                        alert('There was an error in deleting.')
                                    }
                                });
                            }
                        }
                    }
                });
            }
        });
});
    </script>
   
@stop