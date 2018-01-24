@extends('layout')


@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$item ? 'Редактрование: ' . $item->name : 'Новый'}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            {{--action="{{route('adminItem', [$item->id ?: 'add'])}}">--}}
            <div class="box-body">
                <div class="checkbox">
                    <label>
                        {{--TODO Сделать old('status') --}}
                        <input type="checkbox" name="status" {{!$item || $item->status ? 'checked' : ''}}>Активен
                    </label>
                </div>
                <div class="form-group">
                    <label>Родитель</label>
                    <select class="form-control" name="group_id">
                        @foreach($groups as $el)
                            <option value="{{$el['id']}}" {{$el['selected']}}>{{$el['name_hierarchical']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputName">Наименование</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="{{old('name') ?: $item->name}}">
                </div>
                <div class="form-group">
                    <label for="inputAlias">Алиас</label>
                    <input type="text" class="form-control" id="inputAlias" name="alias" value="{{old('alias') ?: $item->alias}}">
                </div>
                <div class="form-group">
                    <label for="inputH1">H1</label>
                    <input type="text" class="form-control" id="inputH1" name="h1" value="{{old('h1') ?: $item->h1}}">
                </div>
                <div class="form-group">
                    <label for="inputText">Описание</label>
                    <textarea id="inputText" class="ck-editor" name="text" rows="10" cols="80">{{old('text') ?: $item->text}}</textarea>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="box-footer">
                {{--TODO: Сохратить и закрыть--}}
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-default" href="{{route($routeNameList)}}">Закрыть</a>
            </div>
        </form>
    </div>

    <!-- /. box -->
@endsection
