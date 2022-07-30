@permission($permission.'-delete')
	<span data-toggle="tooltip" data-placement="bottom" data-original-title="{{ __('admin.delete') }}" >
		<a href="#" data-target="#modal-delete-{{$row->id}}" data-toggle="modal" class="btn btn-sm btn-icon btn-secondary">
			<i class="far fa-trash-alt"></i>
			<span class="sr-only">{{ __('admin.remove') }}</span>
		</a>  
	</span>
@endpermission

@include('commons.admin.modal-delete', [ 'routeName' => $route.'.destroy', 'id'=>$row->id ])