@extends('layout')


@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$item ? 'Редактрование: ' . $item->name : 'Новый'}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
            <div class="box-body">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="status" {{!$item || old('status', $item->status) ? 'checked' : ''}}>Активен
                    </label>
                </div>
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

    <!-- /. box -->
@endsection
