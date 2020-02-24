<form action="{{ route('admin.options.siteOptions.store')  }}"
      method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
            @foreach($siteOptions as $optionsGroup)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">{{ $optionsGroup['title'] }}</div>
                    <div class="card-body">
                        @foreach($optionsGroup['fields'] as $field)

                            @switch($field['type'])
                                @case('text')
                                {{ Html::text($field['key'])
                                ->value(old($field['key'],$options[$field['key']]['value']))
                                ->label($field['title'])
                                ->description($field['description']??"")
                                 }}
                                @break

                                @case('multiLine')
                                {{ Html::textarea($field['key'])
                                ->value(old($field['key'],$options[$field['key']]['value']))
                                ->label($field['title'])
                                ->description($field['description']??"") }}
                                @break

                                @case('richText')
                                {{ Html::textarea($field['key'])
                                ->value(old($field['key'],$options[$field['key']]['value']))
                                ->label($field['title'])
                                ->description($field['description']??"")
                                ->attributes(['row'=>20])
                                }}
                                @push('vendor-scripts')
                                    <script>
                                        $(document).ready(function () {
                                            CKEDITOR.replace('{{ $field['key'] }}',
                                                {
                                                    filebrowserImageBrowseUrl: '/file-manager/ckeditor',
                                                    baseHref: "{{ (url('media/images/')) }}",

                                                });

                                        })
                                    </script>
                                @endpush
                                @break

                            @endswitch
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left">{{ Html::submit()->label('ذخیره') }}</div>
        </div>
    </div>
</form>