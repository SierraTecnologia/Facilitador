
<div class="col-sm-3 col-md-3 sidebar">
  <h3><i class="facilitador-logbook"></i> {{ __('pedreiro::compass.logs.title') }} <small>{{ __('pedreiro::compass.logs.text') }}.</small></h3>
  <div class="list-group">
    @foreach($files as $file)
      <a href="?log={{ base64_encode($file) }}"
         class="list-group-item @if ($current_file == $file) llv-active @endif">
        <i class="facilitador-file-text"></i> {{$file}}
      </a>
    @endforeach
  </div>
</div>
<div class="col-sm-9 col-md-9 table-container">
  @if ($logs === null)
    <div>
      {{ __('pedreiro::compass.logs.file_too_big') }}
    </div>
  @else
    <table id="table-log" class="table table-striped">
      <thead>
      <tr>
        <th>{{ __('pedreiro::compass.logs.level') }}</th>
        <th>{{ __('pedreiro::compass.logs.context') }}</th>
        <th>{{ __('pedreiro::compass.logs.date') }}</th>
        <th>{{ __('pedreiro::compass.logs.content') }}</th>
      </tr>
      </thead>
      <tbody>

      @foreach($logs as $key => $log)
        <tr data-display="stack{{{$key}}}">
          <td class="text-{{{$log['level_class']}}} level"><span class="glyphicon glyphicon-{{{$log['level_img']}}}-sign"
                                                           aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
          <td class="text">{{$log['context']}}</td>
          <td class="date">{{{$log['date']}}}</td>
          <td class="text">
            @if ($log['stack']) <a class="float-right expand btn btn-secondary btn-xs"
                                   data-display="stack{{{$key}}}"><span
                  class="glyphicon glyphicon-search"></span></a>@endif
            {{{$log['text']}}}
            @if (isset($log['in_file'])) <br/>{{{$log['in_file']}}}@endif
            @if ($log['stack'])
              <div class="stack" id="stack{{{$key}}}"
                   style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
              </div>@endif
          </td>
        </tr>
      @endforeach

      </tbody>
    </table>
  @endif
  <div>
    @if($current_file)
      <a href="?download={{ base64_encode($current_file) }}"><span class="glyphicon glyphicon-download-alt"></span>
        {{ __('pedreiro::compass.logs.download_file') }}</a>
      -
      <a id="delete-log" href="?del={{ base64_encode($current_file) }}"><span
            class="glyphicon glyphicon-trash"></span> {{ __('pedreiro::compass.logs.delete_file') }}</a>
      @if(count($files) > 1)
        -
        <a id="delete-all-log" href="?delall=true"><span class="glyphicon glyphicon-trash"></span> {{ __('pedreiro::compass.logs.delete_all_files') }}</a>
      @endif
    @endif
  </div>
</div>
