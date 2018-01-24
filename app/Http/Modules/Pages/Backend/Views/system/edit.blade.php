@extends('layout')


@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$item ? 'Редактрование: ' . $item->name : 'Новый'}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            <div class="box-body">
                <div class="checkbox">
                    <label>
                        @if($item->id === 1)
                            <input type="hidden" name="status" value="1">
                        @else
                            <input type="checkbox" name="status" {{old('status', $item->status) ? 'checked' : ''}} data-toggle="toggle">Активен
                        @endif
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
                <div class="form-group">
                    <label for="inputH1">H1</label>
                    <input type="text" class="form-control" id="inputH1" name="h1" value="{{old('h1', $item->h1)}}">
                </div>
                <div class="form-group">
                    <label for="inputText">Описание</label>
                    <textarea id="inputText" class="ck-editor" name="text" rows="10" cols="80">{{old('text', $item->text)}}</textarea>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="box-footer">
                <button type="submit" name="submit-button" value="save" class="btn btn-primary">Сохранить</button>
                <button type="submit" name="submit-button" value="save-and-close" class="btn btn-primary">Сохранить и закрыть</button>
                <div class="pull-right">
                    <a class="btn btn-default" href="{{route('adminSystemList')}}">Закрыть</a>
                </div>
            </div>
        </form>
    </div>

    <!-- /. box -->
@endsection
