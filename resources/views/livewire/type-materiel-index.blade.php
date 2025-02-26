<div>
    <h1>Liste des Types de Matériel</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->nom }}</td>
                    <td>{{ $type->description }}</td>
                    <td>
                        <a href="{{ route('typeMateriel.edit', $type->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('typeMateriel.destroy', $type->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('typeMateriel.create') }}" class="btn btn-success">Ajouter un Type de Matériel</a>
</div>