<x-master-layout>
    <div class="container">
        <div class="row">
            
            {{-- Alerte --}}
            @if (session('statut'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ session('statut') }}</strong> 
                    </div>
                </div>
            @endif 

            {{-- Titre --}}
            <div class="col-md-12">
                <h1 class="text-center mt-2">Tous nos produits</h1>
                <h5 class="text-center">Notre catalogue comporte {{ nb_produit($produits->count()) }}</h5>
                <hr>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">

                @if (Auth::user() != null && Auth::user()->isAdmin())
                    <div class="ml-2 mb-1">
                        <a class="btn btn-primary btn-sm" href="{{ route('produits.create') }}"><i class="fas fa-plus"></i> Ajouter</a>
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Désignation</th>
                            <th class="col-md-2 text-center">Prix</th>
                            <th class="text-center">Quantité</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            
                            <tr>
                                <td scope="row"></td>
                                <td>{{ $produit->designation }}</td>
                                <td class="text-right">{{ set_thousands($produit->prix, 0) }}</td>
                                <td class="text-right">{{ set_thousands($produit->quantite, 1) }}</td>
                                <td>{{ get_substring($produit->description, 45) }}</td>                                
                                <td>{{ $produit->image }}</td>
                                <td class="d-flex">
                                    <a class="btn btn-info btn-sm mr-2" href="{{ route('produits.show', $produit) }}" title="Détails"><i class="fas fa-eye"></i></a>
                                    
                                    @if (Auth::user() != null && Auth::user()->isAdmin())
                                        
                                        <a class="btn btn-primary btn-sm mr-2" href="{{  route('produits.edit', $produit) }}" title="Modifier"><i class="fas fa-edit"></i></a>

                                        <a onclick="event.preventDefault(); /* 20210428 : pour l'utilisation de sweetalert2 if(confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) document.getElementById('{{-- $produit->id --}}').submit();*/ delConfirm('{{ $produit->id }}');" class="btn btn-danger btn-sm" href="" title="Supprimer"><i class="fas fa-trash"></i></a>
                                            <form id="{{ $produit->id }}" method="post" action="{{ route('produits.destroy', $produit) }}">                    
                                                {{-- directive CSRF pour protéger les données du formulaire --}}
                                                @csrf
                                                {{-- méthode POST précisée --}}
                                                @method("DELETE")     
                                            </form> 
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- pagination --}}
                <div class="row d-flex justify-content-center mt-5">
                    <div class="">
                        {{ $produits->links() }}
                    </div>
                </div>
                

            </div>
        </div>
    </div>
</x-master-layout>