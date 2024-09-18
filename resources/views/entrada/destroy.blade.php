<div class="modal" tabindex="-1" id="modal-delete-{{$entrada->id}}">
  <form action="{{route('entrada.destroy',['entrada'=>$entrada->id])}}" method="post">
    @method('DELETE')
    @csrf
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('main.delete-record')</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>@lang('main.question-delete') {{$entrada->titulo}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
        <button type="submit" class="btn btn-danger">@lang('main.delete')</button>
      </div>
    </div>
  </div>
  </form>
</div>