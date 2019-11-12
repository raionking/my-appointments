@extends('layouts.panel')

@section('title','Mis citas')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Cita # {{ $appointment->id }}</h3>
        </div>       
      </div>
    </div>
    <div class="card-body">
      <h3>Detalle de la cita</h3>      
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Fecha</th> 
              <td>{{ $appointment->scheduled_date }}</td>
            </tr>
            <tr> 
              <th>Descripción</th>
              <td>{{ $appointment->description }}</td>                 
            </tr>
            <tr> 
              <th>Hora</th>                     
              <td>{{ $appointment->scheduled_time}}</td>                        
            </tr>
            <tr>
              <th>Estado</th>
              <td>
                @if($appointment->status == 'Cancelada')
                  <span class="badge badge-danger">{{ $appointment->status }}</span>
                @else
                  <span class="badge badge-success">{{ $appointment->status }}</span>
                @endif
              </td> 
            </tr>            
            @if($role == 'patient' || $role == 'admin')
            <tr>
              <th>Médico</td>
              <td>{{ $appointment->doctor->name }}</td> 
            </tr>
            @endif
            @if($role == 'doctor' || $role == 'admin')
            <tr>
              <th>Paciente</td>
              <td>{{ $appointment->patient->name }}</td> 
            </tr>
            @endif            
            <tr>
              <th>Tipo de cita</td>
              <td>{{ $appointment->type }}</td> 
            </tr> 
            <tr>
              <th>Especialidad</td>
              <td>{{ $appointment->specialty->name }}</td> 
            </tr>                        
          </thead>
          <tbody>                        
          </tbody>
        </table>  

        @if($appointment->status == 'Cancelada')
          <div class="alert alert-default">
            <p>Acerca de la cancelación</p>
            <ul>
              @if($appointment->cancellation)                   
                <li><strong>Motivo de la cancelación:</strong> {{ $appointment->cancellation->justification }}</li> 
                <li><strong>Fecha de la cancelación:</strong> {{ $appointment->cancellation->created_at }}</li>               
                <li><strong>¿Quién canceló la cita?:</strong> 
                  @if(auth()->id() == $appointment->cancellation->cancelled_by_id)
                    Tú
                  @else
                    {{ $appointment->cancellation->cancelled_by->name }}
                  @endif
                </li>               
              @else              
                <li>Observación: Esta cita fue cancelada antes de su confirmación</li>              
              @endif
            </ul>          
          </div>   
        @endif
      </div>
      <a href="{{ url('/appointments') }}" class="btn btn-default" >
        Volver
      </a>
    </div>         
</div>        
@endsection
