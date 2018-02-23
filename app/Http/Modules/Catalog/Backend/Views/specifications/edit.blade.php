@extends('layout')


@section('content')

    @if($item->id)
    <div class="col-md-5">
    @endif
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$item ? 'Редактрование: ' . $item->name : 'Новый'}}</h3>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <td>
                        <label>
                            <input type="checkbox" name="status" {{!$item || old('status', $item->status) ? 'checked' : ''}}>Активен
                        </label>
                    </td>
                    <div class="form-group">
                        <label for="inputName">Наименование</label>
                        <input type="text" class="form-control" id="inputName" name="name" value="{{old('name', $item->name)}}">
                    </div>
                    <div class="form-group">
                        <label for="inputAlias">Алиас</label>
                        <input type="text" class="form-control" id="inputAlias" name="alias" value="{{old('alias', $item->alias)}}">
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="box-footer">
                    <button type="submit" name="submit-button" value="save" class="btn btn-primary">Сохранить</button>
                    <button type="submit" name="submit-button" value="save-and-close" class="btn btn-primary">Сохранить и закрыть</button>
                    <a class="btn btn-default" href="{{route($routeNameList)}}">Закрыть</a>
                </div>
            </form>
        </div>
    @if($item->id)
    </div>
        <div class="col-md-7">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Значения</h3>
                </div>
                <div class="box-body">
                    <table class="items-table js-items-table" data-url="{{$valueSaveUrl}}" data-del-url="{{$valueDeleteUrl}}">
                        <thead>
                        <tr>
                            <th>Опубликовано</th>
                            <th>Наименование</th>
                            <th>Алиас</th>
                            <th></th>
                        </tr>
                        <tr data-id="0">
                            <td class="status-td">
                                <input type="hidden" name="status" value="1">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="name" value="">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="alias" value="">
                            </td>
                            <td class="status-td">
                                <a class="btn btn-default btn-sm js-save-btn">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                        </thead>
                        <tbody class="js-items-table-body">
                            @include('rows', compact('values'))
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @widget('itemsTableScript')
    @endif
@endsection
