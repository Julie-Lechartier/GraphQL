# GRAPHQL

Projet : reproduire une instance GraphQL imitant le fonctionnement d'un réseau social
- profil utilisateur 
- chaque utilisateur peut avoir des abonnés
- chaque utilisateur peut être abonné à 1 ou plusieurs autres
- Chaque utilisateur peut avoir du contenu (image/post)
- chaque post d'un utilisateur peut avoir des likes/comments
- Créer les résolveurs nécessaires à la récupération de l'ensemble de ces données


## DATABASE
création de la base de données avec Doctrine

## GraphQL
Utilisation de API Platform pour utiliser GraphQL. Appel de mon API Platform dans toutes mes entités.
On lance le serveur et on accède à GraphQl avec la route : 
```` 
/api/graphql
````

## FIXTURES

Création de fausses données dans la base de données pour tester les scripts GraphQL

