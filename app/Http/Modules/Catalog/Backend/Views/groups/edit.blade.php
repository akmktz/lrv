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
                        <input type="checkbox" name="status" {{!$item || old('status', $item->status) ? 'checked' : ''}}>Активен
                    </label>
                </div>
                <div class="form-group">
                    <label>Родитель</label>
                    <select class="form-control" name="parent_id">
                        @foreach($groups as $el)
                            <option value="{{$el['id']}}" {{$el['selected']}}>{{$el['name_hierarchical']}}</option>
                        @endforeach
                    </select>
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
                <div class="form-group">
                    <label for="inputSort">Сортировка</label>
                    <input type="number" class="form-control max-w-100" id="inputSort" name="sort" value="{{old('sort', $item->sort)}}">
                </div>
            </div>
            {{ csrf_field() }}
            <div class="box-footer">
                <button type="submit" name="submit-button" value="save" class="btn btn-primary">Сохранить</button>
                <button type="submit" name="submit-button" value="save-and-close" class="btn btn-primary">Сохранить и закрыть</button>
                <div class="pull-right">
                    <a class="btn btn-default" href="{{route($routeNameList)}}">Закрыть</a>
                </div>
            </div>
        </form>
    </div>

    <!-- /. box -->
@endsection
