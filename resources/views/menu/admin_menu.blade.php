<ul class="{{ isset($hasChildren) && $hasChildren ? 'list-unstyled' : 'collapsible collapsible-accordion' }}" style="border:0">

@php
    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }
@endphp

@foreach ($items as $item)
    @php
        $listItemClass = [];
        $styles = null;
        $linkAttributes = null;
        $transItem = $item;

        if (Voyager::translatable($item)) {
            $transItem = $item->translate($options->locale);
        }

        $href = $item->link();

        // Current page
        if(url($href) == url()->current()) {
            array_push($listItemClass, 'active');
        }

        $permission = '';
        $hasChildren = false;

        // With Children Attributes
        if(!$item->children->isEmpty())
        {
            foreach($item->children as $child)
            {
                $hasChildren = $hasChildren || Auth::user()->can('browse', $child);
            }
            if (!$hasChildren) {
                continue;
            }
            $href = '#';
        }
        else
        {
            $linkAttributes =  'href="' . url($href) .'"';

            if(!Auth::user()->can('browse', $item)) {
                continue;
            }
        }
    @endphp

    <li>
        <a class=" {{ $hasChildren ? 'collapsible-header waves-effect arrow-r' : 'waves-effect'}}
        {{ strrpos(Request::url(),url($href)) !== false ? 'active' : ''}}"
           href="{{url($href)}}"
           target="{{ $item->target }}"
           style="color:{{ (isset($item->color) && $item->color != '#000000' ? $item->color : '') }};font-size:15px">
            <div class="row">
                <div class="col-2">
                    <i class="{{ $item->icon_class }}"></i>
                </div>
                <div class="col-8 ">
                    {{ $transItem->title }}
                </div>
                @if($hasChildren)
                    <div class="col-2 pr-2">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>
                @endif
            </div>
        </a>
        @if($hasChildren)
            <div class="collapsible-body">
                @include('voyager::menu.admin_menu', ['items' => $item->children, 'options' => $options, 'innerLoop' => true])
            </div>
        @endif
    </li>
@endforeach

</ul>
