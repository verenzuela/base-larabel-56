
<div class="modal fade" id="modal-delete-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
	{{Form::Open(array('route'=>array($routeName, $id), 'method'=>'delete'))}}
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteModalLabel">{{ __('admin.delete') }}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>{!! __('admin.msg.confirm') !!}</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
	        <button type="submit" class="btn btn-outline-primary">{{ __('admin.confirm') }}</button>
	      </div>
	    </div>
	  </div>
	  {{Form::Close()}}
</div>