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
                            <input type="checkbox" name="status" {{!$item || $item->status ? 'checked' : ''}}>Активен
                        @endif
                    </label>
                </div>
                <div class="form-group">
                    <label for="inputName">Наименование</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="{{$item->name}}">
                </div>
                <div class="form-group">
                    <label for="inputAlias">Алиас</label>
                    <input type="text" class="form-control" id="inputAlias" name="alias" value="{{$item->alias}}">
                </div>
                <div class="form-group">
                    <label for="inputH1">H1</label>
                    <input type="text" class="form-control" id="inputH1" name="h1" value="{{$item->h1}}">
                </div>
                <div class="form-group">
                    <label for="inputText">Описание</label>
                    <textarea id="inputText" class="ck-editor" name="text" rows="10" cols="80">{{$item->text}}</textarea>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-default" href="{{route('adminSystemList')}}">Закрыть</a>
            </div>
        </form>
    </div>

    <!-- /. box -->
@endsection
