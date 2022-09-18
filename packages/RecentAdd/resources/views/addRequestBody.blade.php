@foreach($fields as $f)
    @if($f->getFieldData->i_type == 1)
        <div class="mid-ad">
            <div class="row">
                <div class="col-md-4">
                    <label for="">{{$f->getFieldData->s_name_ar}}</label>
                    <textarea required name="s_answer{{$f->getFieldData->pk_i_id}}"
                              id="s_answer{{$f->getFieldData->pk_i_id}}" cols="30" rows="2"></textarea>
                </div>
            </div>
        </div>
    @elseif($f->getFieldData->i_type == 2)
        <div class="mid-ad">
            <div class="row">
                <div class="col-md-4">
                    <select required name="s_answer{{$f->getFieldData->pk_i_id}}"
                            id="s_answer{{$f->getFieldData->pk_i_id}}" class="form-control">
                        <option disabled selected>{{$f->getFieldData->s_name_ar}}</option>
                        @if($f->fk_i_field_id == 2)
                            <?php
                            $Countries = \App\Helper\Helper::getFieldOptions(2);
                            ?>
                            @foreach($Countries as $c)
                                @if(count($c->getChilds) > 0)
                                    <optgroup label="{{$c->s_name_ar}}">
                                        @foreach($c->getChilds as $c1)
                                            <option value="{{$c1->pk_i_id}}">{{$c1->s_name_ar}}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
                        @else
                            @foreach($f->getFieldData->getOptionField as $p)
                                @if($p->b_enable == 1)
                                    <option value="{{$p->pk_i_id}}">{{$p->s_name_ar}}</option>
                                @endif
                            @endforeach

                        @endif
                    </select>
                </div>
            </div>
        </div>
    @endif
@endforeach
