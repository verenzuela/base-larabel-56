@extends('layouts.admin.master', $seo )

  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => $menuActive ])

      <main class="app-main">
        @component('components.admin.template-edit',
          ['permission'   => $permission,
           'route'        => $route,
           'h1Title'      => __($h1Title.'.update'),
           'row'          => $row,
          ]
        )
          @section('layoutContent')
          <!--  START HTML CONTENT    -->
          
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-label-group">
                    <label for="fls1">{{ __('admin.label.domain') }}</label>
                    <input type="text" name="domain_name" id="domain_name" class="form-control" value="{{ (old('web_setting_id')) ? old('web_setting_id') : $row->webSetting->adm_url }}" {{ ($row->custom) ? '' : 'disabled'  }} />
                    <input type="hidden" id="web_setting_id" name="web_setting_id" value="{{ (old('web_setting_id')) ? old('web_setting_id') : $row->web_setting_id }}">
                    <div id="domainList"></div>

                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                {!! $render->inpunt('name', $row->name, $errors, true, false, $row->custom) !!}
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                {!! $render->inpunt('display_name', $row->display_name, $errors, false) !!}
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    {!! $render->inpunt('width', $row->width, $errors, false, $customLabel='width_pixels', $editable=true, $classOnFirstDiv='', $classOnInput='text-right') !!}
                  </div>
                  <div class="col-md-6">
                    {!! $render->inpunt('height', $row->height, $errors, false, $customLabel='height_pixels', $editable=true, $classOnFirstDiv='', $classOnInput='text-right') !!}
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                {!! $render->switch('status', $row->status) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-3">
                      <!--img class="img-thumbnail" src="{{ env('APP_URL').'/storage/'.$row->img_url }}" alt=""-->
                      <img class="img-thumbnail" src="{{route('assets.image', ['w'=>'-', 'h'=>'-', 'imagePath'=> $row->img_url  ]) }}" alt="">
                  </div>
                  <div class="col-md-9">
                    {!! $render->fileInput('img_url', false) !!}
                  </div>
                </div>
              </div>
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection