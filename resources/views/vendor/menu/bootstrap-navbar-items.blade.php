@foreach($items as $cont => $item)
    @if($cont==0)
        <div class="sidebar-heading">{!! __($item->title) !!}</div>
    @else
        <li class="nav-item">
            @if($item->hasChildren())
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{$cont}}" aria-expanded="true" aria-controls="collapse{{$cont}}">
            @else
            <a class="nav-link" href="{{$item->url()}}">
            @endif
                {!! __($item->title) !!}
            </a>
                    <div id="collapse{{$cont}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
            @if($item->hasChildren())
                @foreach($item->children() as $subitem)
                    <a class="collapse-item" href="{{$subitem->url()}}">{!! __($subitem->title) !!}</a>
                @endforeach
            @endif
                        </div>
                    </div>
        </li>
    @endif
@endforeach
<!--Basado en el menu de la libreria pero con cambios
config('vendor.menu.bootstrap-navbar-items')
src\Lavary\Menu\resources\views\bootstrap-navbar-items.blade.php-->
