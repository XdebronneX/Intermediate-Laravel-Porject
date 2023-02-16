@extends('layouts.main')
@section('content')
    <!-- comments container -->
    <div class="p-3 mb-2 bg-light text-white">
        <div class="comment_block">
            <img src="{{ asset('images/' . $serv->img_path) }}" width="180" height="180">
            <h3>{{ $serv->service_name }}</h3>
            <div class="create_new_comment">
                <form method="get" action="{{ route('comment.req') }}">
                    <!-- current #{user} avatar -->
                    <div class="user_avatar">


                    </div><!-- the input field -->
                    <div class="input_comment">
                        <input type="text" name="comment" placeholder="Join the conversation..">
                        <input type="hidden" name="comid" value="{{ $comid }}">
                    </div>
                    <button type="submit">
                        <div id="s-circle"></div>
                        <span>Comment</span>
                    </button>
                </form>

            </div>


            <!-- new comment -->
            <div class="new_comment">

                <!-- build comment -->
                <ul class="user_comment">

                    <!-- current #{user} avatar -->
                    <div class="user_avatar">

                    </div><!-- the comment body -->
                    <div class="comment_body">
                        <p></p>
                    </div>

                    <!-- comments toolbar -->
                    <div class="comment_toolbar">

                        <!-- start user replies -->
                        <li>

                            <!-- current #{user} avatar -->
                            <div class="user_avatar">

                            </div><!-- the comment body -->
                            @foreach ($service as $ser)
                                <div class="comment_body">
                                    <p>
                                    <div class="replied_to">
                                        <p><span class="user">{{ $ser->name . ':' . $ser->comment }}</span></p>
                                    </div>
                            @endforeach
                            <!-- comments toolbar -->
                            <div class="comment_toolbar">


                        </li>

                </ul>

            </div>




            </li>

            </ul>

        </div>

    </div>
    </div>
@endsection
