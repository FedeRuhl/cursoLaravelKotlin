@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Cancelar turno</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('notification'))
        <div class="alert alert-success" role="alert">
            <strong> {{session('notification')}} </strong>
        </div>
        @endif
        @if($role == 'paciente')
        <p>
             Estás a punto de cancelar tu turno confirmado para la fecha {{ $appointment->scheduled_date}}
             de horario {{ $appointment->scheduled_time_24 }} con el médico {{ $appointment->doctor->name }}
        </p>
        @elseif($role == 'admin')
        <p>
            Estás a punto de cancelar el turno confirmado para el paciente {{ $appointment->patient->name }}
            en la fecha {{ $appointment->scheduled_date}} al horario {{ $appointment->scheduled_time_24 }}
            con el médico {{ $appointment->doctor->name }}
       </p>
        @else
            Estás a punto de cancelar tu turno confirmado para la fecha {{ $appointment->scheduled_date}}
            de horario {{ $appointment->scheduled_time_24 }} con el paciente {{ $appointment->patient->name }}
        @endif

        <p>
            @if($errors->any())
            <ul>
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </div>
            </ul>
            @endif
        </p>
        <form action="{{ route('appointment.cancel', $appointment) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="justification">Por favor, cuéntanos el motivo de la cancelación:</label>
                <textarea name="justification" rows="5" class="form-control" required autofocus></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Cancelar turno</button>
            <a href="{{ route('appointment.'. $role) }}" class="btn btn-primary">
                Volver al listado de turnos sin cancelar
            </a>
        </form>
    </div>
</div>
@endsection