
<div class="modal fade" id="modal-show-{{$emailLog->id}}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
	
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="showModalLabel">{{ __('admin.emailLogs.label.detail') }}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      	<div class="container">
	      		{!! $emailLog->body !!}	
	      	</div>
	      	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
	      </div>
	    </div>
	  </div>
	
</div>