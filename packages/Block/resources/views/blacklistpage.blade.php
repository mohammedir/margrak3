@extends("_outLayout")
@section("body")
    <div class="container">

        <div class="row">
            <div class="right-comment-b">
                <p class="top-pa-green text-center"><a>القائمة السوداء</a></p>
                <br>
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label for="">اكتب رقم الجوال او الحساب البنكي للعضو</label>
                            <input value="{{$search}}" type="text" class="form-control" name="search">
                        </div>
                        <div class="col-md-5 form-group">
                            <input style="margin-top: 20px;" class="btn btn-primary" type="submit" value="بحث">
                        </div>

                    </div>
                </form>
                <div class="mid-pa text-center">
                    @foreach($blacklists as $b)
                        <div class="row coins text-center">
                            <div class="col-md-4"></div>
                            <div class="right-comment-b col-md-4">
                                <p class="top-pa text-center"><a class="black">{{$b->s_title}}</a></p>
                                <div class="bottom-par">
                                    <?= $b->s_desc ?>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection