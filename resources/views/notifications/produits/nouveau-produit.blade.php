{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}

{{-- 20210429 : envoi de notification --}}

@component('mail::message')
# Du nouveau sur OpenShop

## Le produit {{  $produit->designation }} vient d'être modifié sur votre superbe plateforme OpenShop ! 
<br>
Vous trouverez ci-dessous les nouvelles informations sur ce produit. 

### Prix: {{ $produit->prix }}
### Catégorie: {{ $produit->category->libelle }}
<br>
Pour les détails de ce produit, cliquez sur le bouton ci-dessous. 

@component('mail::button', ['url' => route('produits.show', $produit->id)])
Afficher les détails maintenant !
@endcomponent

Merci d'avoir choisi OpenShop pour votre shopping !<br><br>
{{ config('app.name') }}

@component('mail::footer')
    MODIFICATION D'UN PRODUIT !
@endcomponent

@endcomponent 