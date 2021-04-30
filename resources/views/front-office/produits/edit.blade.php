<x-master-layout>
    
    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mt-2">Modification d'un nouveau produit</h1>
                <hr>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                
                <form method="post" action="{{ route('produits.update', $produit) }}" enctype="multipart/form-data">                    
                    {{-- méthode PATCH précisée pour Laravel --}}
                    @method("PUT")                                         
                    {{-- inclusion de morceaus de vues communes à d'autres --}}
                    @include("partials._produit-form") 
                </form>
                
            </div>
        </div>

    </div>

</x-master-layout>