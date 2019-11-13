@extends('layouts.panel')

@section('title','Mis citas')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Cancelar cita</h3>
        </div>       
      </div>
    </div>
    <div class="card-body">
      @if(session('notification'))
      <div class="alert alert-success" role="alert">
        {{ session('notification') }}
      </div>
      @endif

      @if($role == 'patient')
        <p>Estás a punto de cancelar tu cita reservada con el médico <strong> {{ $appointment->doctor->name }} </strong>
          en la Especialidad <strong> {{ $appointment->specialty->name }} </strong>
          para el día <strong> {{ $appointment->scheduled_date }} </strong>
          ( hora <strong> {{ $appointment->scheduled_time_12 }} ) </strong>
        </p>
      @elseif($role == 'doctor')
        <p>Estás a punto de cancelar tu cita con el paciente <strong> {{ $appointment->patient->name }} </strong>
          en la Especialidad <strong> {{ $appointment->specialty->name }} </strong>
          para el día <strong> {{ $appointment->scheduled_date }} </strong>
          ( hora <strong> {{ $appointment->scheduled_time_12 }} ) </strong>
        </p>
      @else
        <p>Estás a punto de cancelar la cita reservada por el paciente <strong> {{ $appointment->patient->name }} </strong>
          para ser atentido por el médico <strong> {{ $appointment->doctor->name }} </strong>
          en la Especialidad <strong> {{ $appointment->specialty->name }} </strong>
          para el día <strong> {{ $appointment->scheduled_date }} </strong>
          ( hora <strong> {{ $appointment->scheduled_time_12 }} ) </strong>
        </p>
      @endif
      <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="justification">Por favor cuéntanos el motivo de la cancelación</label>
          <textarea name="justification" rows="3" class="form-control" required=""></textarea>
        </div>        
        <button class="btn btn-danger" type="submit">Cancelar</button>
        <a href="{{ url('/appointments') }}" class="btn btn-default">
          Volver al listado de citas sin cancelar
        </a>
      </form>

    </div>      
</div>        
@endsection
