@component('mail::message')
# Du nouveau sur OpenShop

## Un nouveau produit vient d'être ajouté sur votre superbe plateforme OpenShop ! 
<br>
Vous trouverez ci-dessous les informations sur le nouveau produit. 

### Désignation: {{  $produit->designation }}
### Prix: {{ $produit->prix }}
### Catégorie: {{ $produit->category->libelle }}
<br>
Pour commander ce produit, cliquez sur le bouton ci-dessous. 

@component('mail::button', ['url' => route('produits.show', $produit->id)])
Commandez ce produit maintenant !
@endcomponent

Merci d'avoir choisi OpenShop pour votre shopping !<br><br>
{{ config('app.name') }}

@component('mail::footer')
    {{ 2021 }} !
@endcomponent

@endcomponent 

