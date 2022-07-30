
<div class="modal fade" id="modal-show-{{$audit->id}}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
	
	  <div class="modal-dialog modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="showModalLabel">{{ __('admin.audit.label.detail') }}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.audit.label.id') }}:</b></div>
	      		<div class="col-9">{{$audit->id}}</div>
	      	</div>
	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.audit.label.user') }}:</b></div>
	      		<div class="col-9">{{$audit->getUserName($audit->user_id)}}</div>
	      	</div>
	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.label.createdAt') }}:</b></div>
	      		<div class="col-9">{{$audit->created_at->format('l jS \\of F Y h:i:s A') }}</div>
	      	</div>

	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.audit.label.fromUrl') }}:</b></div>
	      		<div class="col-9">{{$audit->url}}</div>
	      	</div>
	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.audit.label.fromIp') }}:</b></div>
	      		<div class="col-9">{{$audit->ip_address}}</div>
	      	</div>
	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.audit.label.userAgent') }}:</b></div>
	      		<div class="col-9">{{$audit->user_agent}}</div>
	      	</div>

	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.audit.label.objectName') }}:</b></div>
	      		<div class="col-9">{{$audit->auditable_type}}</div>
	      	</div>
	      	<div class="row" >
	      		<div class="col-3"><b>{{ __('admin.audit.label.objectId') }}:</b></div>
	      		<div class="col-9">{{$audit->auditable_id}}</div>
	      	</div>
	      	
	      	<hr>

	      	<div class="row" >
	      		<div class="col-6"><b>{{ __('admin.audit.label.oldValues') }}</b></div>
	      		<div class="col-6"><b>{{ __('admin.audit.label.NewValues') }}</b></div>
	      	</div>
	      	<div class="row" >
	      		<div class="col-6">
	      			<code style="font-size: 11px; color: red;">
	      				<?php $data = json_decode($audit->old_values); ?>
	      				@if(array_key_exists('terms', $data))
	      					{{ $audit->old_values }}
	      				@else
	      					{!! nl2br(str_replace(' ', '&nbsp;', (json_encode(json_decode($audit->old_values), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)))) !!}
	      				@endif
	      			</code>
	      		</div>
	      		<div class="col-6">
	      			<code style="font-size: 11px; color: green;">
	      				<?php $data = json_decode($audit->new_values); ?>
	      				@if(array_key_exists('terms', $data))
	      					{{ $audit->new_values }}
	      				@else
	      					{!! nl2br(str_replace(' ', '&nbsp;', (json_encode(json_decode($audit->new_values), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)))) !!}
	      				@endif

	      			</code>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
	      </div>
	    </div>
	  </div>
	
</div>