@if ($categories)

    <ul class="ul-sort" id="{{ $level==0 ? 'cat-list' : ''}}">
    @foreach($categories as $category)

        <li class="parent_li" data-id="{{ $category->id }}" data-json='{{ json_encode($category) }}'>

            <input type="hidden" name="ids[]" value="{{ $category->id }}">
            
            <i class="fa fa-bars"></i> {{ $category->name }} 
            
            <span class="badge badge-warning add_subcategory_cancel d-none" data-id="{{ $category->id }}"> <i class="fa fa-minus"></i></span> 

            <span class="badge badge-success add_subcategory"> <i class="fa fa-plus"></i></span> 
            
            <span class="badge badge-primary category_settings" data-id="{{ $category->id }}"> <i class="fa fa-edit"></i></span>
            
            <span class="badge badge-danger remove_category" data-id="{{ $category->id }}"><i class="fa fa-trash"></i></span>

            <br><input class='new_subcategory_input d-none ml-4' type='text' data-parent-id="{{$category->id}}" placeholder='enter subcategory name'>

            @if(count($category->subcategories))
                @include('admin.sections.subcategories', ['categories' => $category->subcategories, 'level' => $level+1])
            @endif
        </li>
    @endforeach
    </ul>

@endif
