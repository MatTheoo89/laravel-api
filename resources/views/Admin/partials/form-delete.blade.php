<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{$project->id}}">
    <i class="fa-solid fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modal{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content bg-dark">
        <div class="modal-header">
        <h1 class="modal-title fs-5 text-bold" id="exampleModalLabel">Eliminazione post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <span>Confermi l'eliminazione del post: <strong><span class="text-danger">{{$project->name}}</span></strong></span>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{route('admin.projects.destroy',$project)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    </div>
</div>