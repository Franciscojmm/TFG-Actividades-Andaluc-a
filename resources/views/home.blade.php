@extends('layouts.app')

@section('content')


    @role('encargado')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card card_home animate__animated animate__bounce">
                <div class="card-header listados-head text-center">{{ __('Listado de usuarios') }}</div>
                <div class="card-body">
                    <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120">
                    <path fill="none" d="M0 0h24v24H0z"/><path d="M2 22a8 8 0 1 1 16 0H2zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm7.363 2.233A7.505 7.505 0 0 1 22.983 22H20c0-2.61-1-4.986-2.637-6.767zm-2.023-2.276A7.98 7.98 0 0 0 18 7a7.964 7.964 0 0 0-1.015-3.903A5 5 0 0 1 21 8a4.999 4.999 0 0 1-5.66 4.957z"/>
                    </svg>
                        <a class="btn btn-info btn_home" href="{{ route('listado_usu') }}">{{ __('Listado de usuarios') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card_home animate__animated animate__bounce">
                <div class="card-header listados-head text-center">{{ __('Crear Usuario') }}</div>
                <div class="card-body">
                    <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="none" d="M0 0h24v24H0z"/><path d="M14 14.252V22H4a8 8 0 0 1 10-7.748zM12 13c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm6 4v-3h2v3h3v2h-3v3h-2v-3h-3v-2h3z"/></svg>
                    <a class="btn btn-info btn_home" href="{{ route('crear_usuario') }}">{{ __('Añadir usuario') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card_home animate__animated animate__bounce">
                <div class="card-header listados-head text-center">{{ __('Listado de actividades') }}</div>
                <div class="card-body">
                    <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="none" d="M0 0h24v24H0z"/><path d="M20 22H6.5A3.5 3.5 0 0 1 3 18.5V5a3 3 0 0 1 3-3h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zm-1-2v-3H6.5a1.5 1.5 0 0 0 0 3H19z"/></svg>
                    <a class="btn btn-success btn_home" href="{{ route('listado_actividades') }}">{{ __('Listado de Actividades') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card_home animate__animated animate__bounce">
                <div class="card-header listados-head text-center">{{ __('Añadir actividad') }}</div>
                <div class="card-body">
                    <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="none" d="M0 0H24V24H0z"/><path d="M20 2c.552 0 1 .448 1 1v18c0 .552-.448 1-1 1H6c-.552 0-1-.448-1-1v-2H3v-2h2v-2H3v-2h2v-2H3V9h2V7H3V5h2V3c0-.552.448-1 1-1h14zm-6 6h-2v3H9v2h2.999L12 16h2l-.001-3H17v-2h-3V8z"/></svg>
                    <a class="btn btn-success btn_home" href="{{ route('crear_actividad') }}">{{ __('Crear Actividad') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole
@role('profesor')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card card_home animate__animated animate__bounce">
                    <div class="card-header listados-head text-center">{{ __('Mis Datos') }}</div>
                    <div class="card-body">
                        <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 22a8 8 0 1 1 16 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6z"/></svg>
                        <a class="btn btn-info btn_home" href="{{ route('perfil') }}">{{ __('Ver mi perfil') }}</a>
                    </div>
                </div>
            </div>

                <div class="col-md-3">
                    <div class="card card_home animate__animated animate__bounce">
                        <div class="card-header listados-head text-center">{{ __('Mis Actividades') }}</div>
                        <div class="card-body">
                            <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="none" d="M0 0L24 0 24 24 0 24z"/><path d="M20 2c.552 0 1 .448 1 1v3.757l-8.999 9-.006 4.238 4.246.006L21 15.242V21c0 .552-.448 1-1 1H4c-.552 0-1-.448-1-1V3c0-.552.448-1 1-1h16zm1.778 6.808l1.414 1.414L15.414 18l-1.416-.002.002-1.412 7.778-7.778zM12 12H7v2h5v-2zm3-4H7v2h8V8z"/></svg>
                            <a class="btn btn-info btn_home" href="{{ route('mis_actividades') }}">{{ __('Mis Actividades') }}</a>
                        </div>
                    </div>
                </div>

                    <div class="col-md-3">
                        <div class="card card_home animate__animated animate__bounce">
                            <div class="card-header listados-head text-center">{{ __('Todas las Actividades') }}</div>
                            <div class="card-body">
                                <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="none" d="M0 0h24v24H0z"/><path d="M7 6V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-3v3c0 .552-.45 1-1.007 1H4.007A1.001 1.001 0 0 1 3 21l.003-14c0-.552.45-1 1.007-1H7zm2 0h8v10h2V4H9v2zm-2 5v2h6v-2H7zm0 4v2h6v-2H7z"/></svg>
                                <a class="btn btn-info btn_home" href="{{ route('actividades') }}">{{ __('Ver las Actividades') }}</a>
                            </div>
                        </div>
                    </div>




        </div>
    </div>
@endrole
    @if(\Illuminate\Support\Facades\Auth::user()== null)
    <h1>Actividades Andalucía</h1>
    @endif
@endsection

