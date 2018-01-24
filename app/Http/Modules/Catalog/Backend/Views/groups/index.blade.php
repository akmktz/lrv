@extends('layout')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Список</h3>
            <div class="pull-right">
                <a type="button" href="{{route($routeNameAdd)}}"
                   class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                    Добавить
                </a>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive mailbox-messages">
                <div class="col-md-12">
                    @foreach($list as $item)
                        <ul class="list-group" style="margin-left: {{$item['level']*25}}px">
                            <li class="list-group-item">
                                <table class="" width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="70px">
                                            <div class="checkbox">
                                                <label>
                                                    <a href="#" class="js-status" data-id="{{$item['id'] }}"
                                                       data-val="{{$item['status'] ? 1 : 0}}"
                                                    ><i class="fa fa-fw {{$item['obj'] ? $item['obj']->getStatusClass() : ''}}"></i></a>
                                                </label>
                                            </div>
                                            </td>
                                        <td><a href="{{route('adminGroup', [$item['id']])}}">{{$item['name']}}</a></td>
                                        <td width="30%"><a href="{{route('adminGroup', [$item['id']])}}">{{$item['alias']}}</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                    @endforeach
                    <div class="mailbox-controls ">
                        <a type="button" href="{{route($routeNameAdd)}}"
                           class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                            Добавить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id="js-page-parameters" data-url="{{route($routeNameList)}}" data-token="{{csrf_token()}}"></span>
@endsection

