@extends("_outLayout")
@section("body")
    <div class="container">
        <div class="row">
            <div class="right-comment-b">
                <p class="top-pa-green text-center"><a>القوانين</a></p>
                <div class="mid-pa text-center">
                    @foreach($rules as $b)
                        <div class="row coins text-center">
                            <div class="col-md-2"></div>
                            <div class="right-comment-b col-md-8">
                                <p class="top-pa text-center"><a class="black">{{$b->s_title}}</a></p>
                                <div class="bottom-par">
                                    <?= $b->s_desc ?>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection