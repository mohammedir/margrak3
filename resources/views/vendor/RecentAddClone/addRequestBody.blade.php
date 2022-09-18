@foreach($fields as $f)
    @if($f->getFieldData->i_type == 1)
        <div class="mid-ad">
            <div class="row">
                <div class="col-md-4">
                    <label for="">{{$f->getFieldData->s_name_ar}}</label>
                    <textarea required name="s_answer{{$f->getFieldData->pk_i_id}}" cols="30" rows="2"></textarea>
                </div>
            </div>
        </div>
    @elseif($f->getFieldData->i_type == 2)
        <div class="mid-ad">
            <div class="row">
                <div class="col-md-4">
                    <select required name="s_answer{{$f->getFieldData->pk_i_id}}" class="form-control">
                        <option disabled selected>{{$f->getFieldData->s_name_ar}}</option>
                        @foreach($f->getFieldData->getOptionField as $p)
                            <option value="{{$p->pk_i_id}}">{{$p->s_name_ar}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endif
@endforeach
