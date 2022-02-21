<div class="page-aside col-10 col-sm-10 col-md-4 col-lg-3 col-xl-2">
    <div class="page-aside-section middle">
        <a class="list-group-item" href="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name}}">
            <span class="item-right badge badge-info countNumber">{{ ($mainItem) ? count($mainItem): 0 }}</span>
            <p class="md-accounts-alt" aria-hidden="true" >{{ $section->name }}</p>
        </a>
    </div>
    <div class="page-aside-section">
        <h5 class="page-aside-title">{{$secondItemName}}</h5>
        <div class="list-group has-actions">
            @if(isset($secondItem))
                @foreach($secondItem as $index => $item)
                    <div class="list-group-item">
                        <a href="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/buscar/secondItem/'.$item->id}}">
                            <div class="list-content">
                                <span class="item-right text-primary"></span>
                                <span class="list-text">{{ $item->display_name }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>