@permission($permission.'-edit')
	<a href="{{ route($route.'.edit', ['row' => $row->id]) }}" class="btn btn-sm btn-icon btn-secondary">
		<i class="fa fa-pencil-alt"></i>
		<span class="sr-only">{{ __('admin.edit') }}</span>
	</a>
@endpermission