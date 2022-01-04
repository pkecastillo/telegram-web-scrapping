@extends('layouts.app')

@section('content')
<div class="container">

    <table class="table" id="table_id">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Description</th>
                <th>Updated At</th>
                <th>URL</th>
                <th>Is_published</th>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $item)
            <tr>
                <td scope="row">{{$item->title}}</td>
                <td>{{$item->location}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->updated_at}}</td>
                <td>
                    <a href="{{$item->url}}" target="_blank">VER OFERTA</a>
                </td>
                <td>
                    @if ($item->is_published == false)
                        <span class="badge badge-danger">No Publicado</span>
                    @else
                    <span class="badge badge-success">Publicado</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('publish', $item)}}" class="btn btn-info">Publicar</a>
                    <button type="button" class="btn btn-primary">Editar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>
@endsection

@push('javascripts')

<script>
    $(document).ready( function () {
    $('#table_id').DataTable({
        "order":[[3, "dec"]]
    });
} );
</script>

@endpush
