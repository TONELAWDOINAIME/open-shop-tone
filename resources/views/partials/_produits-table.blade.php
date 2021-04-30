{{-- 20210428 : Exportation de la vue --}}

<table class="table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Désignation</th>
            <th class="col-md-2 text-center">Prix</th>
            <th class="text-center">Quantité</th>
            <th>Description</th>
            {{-- <th>Image</th>
            <th>Actions</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($listProduits as $produit)
            <tr>
                <td scope="row">{{ ++$n }}</td>
                <td>{{ $produit->designation }}</td>
                <td class="text-right">{{ set_thousands($produit->prix, 0) }}</td>
                <td class="text-right">{{ set_thousands($produit->quantite, 1) }}</td>
                <td>{{ get_substring($produit->description, 45) }}</td>                                
                {{-- <td>{{ $produit->image }}</td>
                <td class="d-flex">
                    <a class="btn btn-info btn-sm mr-2" href="{{ route('produits.show', $produit) }}" title="Détails"><i class="fas fa-eye"></i></a>
                    
                    @if (Auth::user() != null && Auth::user()->isAdmin())
                        
                        <a class="btn btn-primary btn-sm mr-2" href="{{  route('produits.edit', $produit) }}" title="Modifier"><i class="fas fa-edit"></i></a>

                        <a onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) document.getElementById('{{ $produit->id }}').submit();" class="btn btn-danger btn-sm" href="" title="Supprimer"><i class="fas fa-trash"></i></a>
                            <form id="{{ $produit->id }}" method="post" action="{{ route('produits.destroy', $produit) }}">                    
                                {{-- directive CSRF pour protéger les données du formulaire --}}
                                @csrf
                                {{-- méthode POST précisée --} }
                                @method("DELETE")     
                            </form> 
                    @endif

                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>