@extends('layouts.admin')

@section('content')
<div class="container-fluid text-end">
    <a class="btn btn-success me-5 my-5" href="{{route('admin.projects.create')}}"><i class="fa-solid fa-plus"></i> New project</a>
</div>
    <div class="container my-5">
        <h1 class="text-center">My projets</h1>
    </div>
    <div class="my-container">
        <table class="table align-middle">

            <thead>
                <tr>
                    <th class="text-white text-center" scope="col">ID</th>
                    <th class="text-white text-center" scope="col">image</th>
                    <th class="text-white text-center" scope="col">Name project</th>
                    <th class="text-white text-center" scope="col">Type</th>
                    <th class="text-white text-center" scope="col">Tecnologia</th>
                    <th class="text-white text-center" scope="col">summary</th>
                    <th class="text-white text-center" style="width: 175px;" scope="col">AZIONI</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td class="text-white">{{$project->id}}</td>
                        <td class="text-white">
                            <img src="{{$project->cover_image ? asset('storage/' . $project->cover_image) : 'https://www.pngitem.com/pimgs/m/579-5798581_image-placeholder-circle-hd-png-download.png'}}" alt="{{$project->name}}" class="thumb">
                        </td>
                        <td class="text-white">{{$project->name}}</td>

                        {{-- @dd($project->fx_type) --}}

                        <td class="text-white">
                            <span class="badge text-bg-info">{{$project->type?->type}}</span>
                        </td>
                        <td class="text-white">
                            @forelse ($project->technologies as $technolgy)
                                <span class="badge text-bg-warning">{{$technolgy->type}}</span>
                            @empty
                                - no data -
                            @endforelse

                        </td>
                        <td class="text-white"> {{$project->summary}}</td>
                        <td class="text-white text-center" style="width: 175px;">
                            <a class="btn btn-info" href="{{route('admin.projects.show', $project)}}"><i class="fa-regular fa-eye"></i></a>
                            <a class="btn btn-warning" href="{{route('admin.projects.edit', $project)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                            @include('Admin.partials.form-delete')
                        </td>
                    </tr>
                @empty

                    <h2>Nesun risultato</h2>

                @endforelse

            </tbody>
        </table>
        <div>
            {{ $projects->links() }}
        </div>
    </div>
@endsection