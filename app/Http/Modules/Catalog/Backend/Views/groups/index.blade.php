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
                    <div class="dd">
                        @include('list', ['parentId' => 0])
                    </div>
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
