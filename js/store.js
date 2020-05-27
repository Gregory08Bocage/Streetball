function detailProduit(id_produit) {
    location = `detail.php?id_produit=${id_produit}`;
}
function ajouterProduit(id_categorie) {
    location = `editer.php?id_categorie=${id_categorie}`;
}
function editerProduit(evt, id_produit) {
    evt.stopPropagation();
    location = `editer.php?id_produit=${id_produit}`;
}
function supprimerProduit(evt, id_produit) {
    evt.stopPropagation();
    if (confirm("Vraiment supprimer ?")) {
        let url = 'Supprimer.php?id_produit=' + id_produit;
        fetch(url)
                .then(response => {
                    if (response.ok)
                        location.reload
                })
                                        .catch(error => console.error(error));
    }
}
function supprimerImage(evt, id_produit) {
    evt.stopPropagation();
    if (confirm("Vraiment supprimer ?")) {
        let url = 'SupprimerImage.php?id_produit=' + id_produit;
        fetch(url)
                .then(response => {
                    if (response.ok)
                        location.reload
                })
                                        .catch(error => console.error(error));
    }
}


