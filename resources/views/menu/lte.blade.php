@if(!isset($innerLoop))
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
@else
<ul class="nav nav-treeview">
@endif
    @php
        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }
    @endphp

    @foreach ($items as $item)
        @php
            $listItemClass = [];
            $listLinkClass = [];
            $styles = null;
            $linkAttributes = null;
            $transItem = $item;

            $href = $item->link();

            // Current page
            if(url($href) == url()->current()) {
                array_push($listItemClass, 'menu-open');
                array_push($listLinkClass, 'active');
            }

            $permission = '';
            $hasChildren = false;

            // With Children Attributes
            if(!$item->children->isEmpty())
            {
                foreach($item->children as $child)
                {
                    $hasChildren = $hasChildren || Auth::user()->can('browse', $child);

                    if(url($child->link()) == url()->current())
                    {
                        array_push($listItemClass, 'menu-open');
                    }
                }
                if (!$hasChildren) {
                    continue;
                }
                array_push($listItemClass, 'has-treeview');
            }
            else
            {
                array_push($listItemClass, 'waves-effect');
                if(!Auth::user()->can('browse', $item)) {
                    continue;
                }
            }
        @endphp

        <li class=" nav-item {{ implode(" ", $listItemClass) }}">
            <a href="{{ url($href) }}" class="nav-link" target="{{ $item->target }}" >
                <i class="nav-icon {{ $item->icon_class }} pr-1"></i>
                <p class="title">
                    {{ $transItem->title }}
                    @if($hasChildren)
                    <i class="right fa fa-angle-left"></i>
                    @endif
                </p>
            </a>
            @if($hasChildren)
                @include('voyager::menu.lte', ['items' => $item->children, 'options' => $options, 'innerLoop' => true])
            @endif
        </li>
    @endforeach

</ul>
