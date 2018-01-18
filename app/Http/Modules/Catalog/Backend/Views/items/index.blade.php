@extends('layout')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Список</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                &nbsp;
                <a type="button" href="{{route($routeNameAdd)}}"
                        class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                    Добавить</a>
                <div class="pull-right">
                {{ $list->links() }}
                <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
            </div>
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Наименование</th>
                        <th>Алиас</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $obj)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><a href="#" class="js-status" data-id="{{$obj->id}}" data-val="{{$obj->status ? 1 : 0}}"
                                ><i class="fa fa-fw {{$obj->getStatusClass()}}"></i></a></td>
                            <td><a href="{{route($routeNameEdit, [$obj->id])}}">{{$obj->name}}</a></td>
                            <td><a href="{{route($routeNameEdit, [$obj->id])}}">{{$obj->alias}}</a></td>
                            <td><a href="#" data-toggle="popover" title="Управление" data-trigger="focus"
                                   data-content="К сожалению еще не реализовано">
                                    <i class="fa fa-gear js-dropDownMenu"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                &nbsp;
                <a type="button" href="{{route($routeNameAdd)}}"
                   class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                    Добавить</a>
                <div class="pull-right">
                {{ $list->links() }}
                <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
            </div>
        </div>
    </div>
    <!-- /. box -->
    <span id="js-page-parameters" data-url="{{route($routeNameList)}}" data-token="{{ csrf_token() }}"></span>
@endsection

