<ol class="dd-list">

@foreach ($items as $item)

    <li class="dd-item" data-id="{{ $item->id }}">
        <div class="float-right item_actions">
            <div class="btn btn-sm btn-danger float-right delete" data-id="{{ $item->id }}">
                <i class="facilitador-trash"></i> {{ __('pedreiro::generic.delete') }}
            </div>
            <div class="btn btn-sm btn-primary float-right edit"
                data-id="{{ $item->id }}"
                data-title="{{ $item->title }}"
                data-url="{{ $item->url }}"
                data-target="{{ $item->target }}"
                data-icon_class="{{ $item->icon_class }}"
                data-color="{{ $item->color }}"
                data-route="{{ $item->route }}"
                data-parameters="{{ json_encode($item->parameters) }}"
            >
                <i class="facilitador-edit"></i> {{ __('pedreiro::generic.edit') }}
            </div>
        </div>
        <div class="dd-handle">
            @if($options->isModelTranslatable)
                @include('pedreiro::shared.forms.multilingual.input-hidden', [
                    'isModelTranslatable' => true,
                    '_field_name'         => 'title'.$item->id,
                    '_field_trans'        => json_encode($item->getTranslationsOf('title'))
                ])
            @endif
            <span>{{ $item->title }}</span> <small class="url">{{ $item->link() }}</small>
        </div>
        @if(!$item->children->isEmpty())
            @include('facilitador::menu.admin', ['items' => $item->children])
        @endif
    </li>

@endforeach

</ol>
