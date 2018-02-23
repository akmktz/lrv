@foreach($values as $value)
    <tr data-id="{{$value->id}}">
        <td class="status-td">
            <input type="checkbox" name="status" {{$value->status ? 'checked' : ''}}>
        </td>
        <td>
            <input type="text" class="form-control" name="name" value="{{$value->name}}">
        </td>
        <td>
            <input type="text" class="form-control" name="alias" value="{{$value->alias}}">
        </td>
        <td class="status-td">
            <a class="btn btn-default btn-sm js-save-btn">
                <i class="fa fa-save"></i>
            </a>
            <a class="btn btn-default btn-sm js-del-btn">
                <i class="fa fa-remove"></i>
            </a>
        </td>
    </tr>
@endforeach