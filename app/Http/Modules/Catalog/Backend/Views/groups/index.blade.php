@extends('layout')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Список</h3>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive mailbox-messages">
                <div class="col-md-12">
                    @foreach($list as $obj)
                        <ul class="list-group" style="margin-left: {{$obj['level']*25}}px">
                            <li class="list-group-item">
                                <table class="" width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="70px">
                                            <div class="checkbox">
                                                <label>
                                                    <a href="#" class="js-status" data-id="{{$obj['id'] }}"
                                                       data-val="{{$obj['status'] ? 1 : 0}}"
                                                    ><i class="fa fa-fw {{$obj['obj']->getStatusClass()}}"></i></a>
                                                </label>
                                            </div>
                                            </td>
                                        <td><a href="{{route('adminGroup', [$obj['id']])}}">{{$obj['name']}}</a></td>
                                        <td width="30%"><a href="{{route('adminGroup', [$obj['id']])}}">{{$obj['alias']}}</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <span id="js-page-parameters" data-url="{{$url}}" data-token="{{ csrf_token() }}"></span>
@endsection

