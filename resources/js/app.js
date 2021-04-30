require('./bootstrap');

require('alpinejs'); 


//  20210428 : importation de la classe sweetalert2 
import Swal from "sweetalert2"; 

//  définition des boîtes de dialogue personnalisées 
//  https://sweetalert2.github.io/ pour prendre des codes exemples 
window.delConfirm = function (formId) {
    Swal.fire({
        title: 'Etes-vous sûr de vouloir supprimer ce produit ?',
        text: "Cette opération est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer !', 
        cancelButtonText: 'Annuler', 
      }).then((result) => {
        if (result.isConfirmed) {
          /*Swal.fire(
            'Suppression !',
            'Votre produit a bien été supprimé.',
            'success'
          )*/
          document.getElementById(formId).submit() 
        }
      })
}
