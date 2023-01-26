@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-end me-4">
            <a class="btn btn-warning" href="{{route('admin.projects.index')}}">Torna indietro</a>
        </div>

        <h1 class="ms-4 mb-5">Edit Comics</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        
        @endif

        <div class="form-container">
            <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">name project *</label>
                    <input  type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{old('name', $project->name)}}"
                            placeholder="name project">
                    @error('name')
                    <div id="invalidCheck3Feedback" class="invalid-feedback">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client name *</label>
                    <input  type="text"
                    class="form-control @error('client_name') is-invalid @enderror"
                            id="client_name"
                            name="client_name"
                            value="{{old('client_name', $project->client_name)}}"
                            placeholder="Client name">
                    @error('client_name')
                        <div id="invalidCheck3Feedback" class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">types</label>
                    <select class="form-select" name="type_id" aria-label="Default select example">
                        <option value="">Selezionare una tipologia</option>
                        @foreach ($types as $type)
                            <option
                            @if($type->id == old('type_id')) selected @endif
                                value="{{$type->id}}">{{$type->type}}</option>
                        @endforeach
                    </select>
        
                </div>

                <div class="mb-3">
                    <p for="date" class="form-label">tag</p>
                    @foreach ($technologies as $technology )
                        <input type="checkbox"
                        id="technology{{$loop->iteration}}"
                        name="technologies[]"
                        value="{{$technology->id}}"
        
                        @if (!$errors->all() && $project->technologies->contains($technology))
                            checked
                        @elseif ($errors->all() && in_array($technology->id, old('technologies',[])))
                            checked
                        @endif>

                        <label class="me-3" for="technology{{$loop->iteration}}">{{$technology->type}}</label>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Image project *</label>
                    <input  type="file"
                            onchange="showImage(event)"
                            class="form-control @error('cover_image') is-invalid @enderror"
                            id="cover_image"
                            name="cover_image"
                            value="{{$project->cover_image}}"
                            placeholder="cover_image">
                    @error('cover_image')
                        <div id="invalidCheck3Feedback" class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                    <div class="image mt-2" >
                        <img id='output-image' width="75" src="{{$project->cover_image ? asset('storage/' . $project->cover_image) : 'https://www.pngitem.com/pimgs/m/579-5798581_image-placeholder-circle-hd-png-download.png'}}" alt="{{$project->name}}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="summary" class="form-label">summary *</label>
                    <textarea   class="text-black"
                                id="text"
                                name="summary">{{old('summary', $project->description)}}</textarea>
                    @error('summary')
                        <div id="invalidCheck3Feedback" class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-5 ms-4">Aggiorna</button>
            </form>
    
        </div>

    </div>


    <script>
        // CKEditor
    ClassicEditor
            .create( document.querySelector( '#text' ),{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            })
            .catch( error => {
                console.error( error );
            } );
    function showImage(event){
        const tagImage = document.querySelector('#output-image');
        tagImage.src = URL.createObjectURL(event.target.files[0]);
	}

    </script>
@endsection