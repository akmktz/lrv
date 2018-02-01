<ol class="dd-list">
    @foreach($list[$parentId] as $item)
        <li class="dd-item dd3-item" data-id="{{$item->id}}">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content">
                <span>
                    <a href="#" class="js-status" data-id="{{$item->id}}"
                       data-val="{{$item->status ? 1 : 0}}"
                    ><i class="fa fa-fw {{$item->getStatusClass()}}"></i></a>
                </span>
                <span>
                    <a href="{{route('adminGroup', [$item['id']])}}">{{$item['name']}}</a>
                </span>
            </div>
            @if(!empty($list[$item->id]))
                @include('list', ['parentId' => $item->id])
            @endif
        </li>
    @endforeach
</ol>