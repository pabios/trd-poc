## Morpion (Ce jeu n'est pas facile non plus !)
- Le but de ce jeu est de réaliser un jeu du morpion, il vous faudra utiliser des tableaux et si possible factoriser au maximum avec des fonctions comme on l'a vu.
- Le jeu se passe au tour par tour entre deux joueurs sur un plateau de cases en 3x3
- Le premier joueur qui débute la partie est aléatoire !
- Ce premier joueur réalisera des ronds, tandis que le second joueur réalisera des croix
- Le but est donc de choisir un emplacement où le joueur décide de mettre son signe (attention, un endroit déjà pris ne doit pas pouvoir être repris à nouveau). Vous pouvez par exemple donner des possibilités de A1 à C3 pour que l'utilisateur choisisse l'emplacement (ou de 1 à 9 si vous préférez)
- La première personne qui gagne est celle qui arrive à faire une ligne complète de son signe (en ligne verticale, horizontale ou diagonale) Cette étape n'est pas facile !
- Le but est d'également afficher dans la console un tableau qui récapitule où l'on en est dans la partie au fur et à mesure des tours des joueurs

## Liste de contacts
- Créer un programme qui permet à un utilisateur de gérer une liste de contacts complètement
- Cette liste doit être gérée avec une List de string et tentez de réaliser le code le plus propre possible en utilisant des fonctions et en utilisant le Linq
- Chaque contact est un string qui ne peut être vide ou null
- L'utilisateur choisi entre un choix parmis plusieurs et le programme boucle tant qu'il n'a pas choisi la dernière option (qui réinitialise tous les contacts)
    - 1) Ajouter un contact
    - 2) Lister l'ensemble des contacts
    - 3) Afficher le premier contact qui match une condition
    - 4) Supprimer un contact
    - 5) Modifier un contact existant
    - 6) Filtrer tous les contacts selon une entrée utilisateur (donc afficher les contacts suite à un .Where)
    - 7) Afficher le nombre de contacts
    - 8) Afficher afficher true / false si le contact contient la lettre 'a' ou 'A' (avec .Select)
    - 9) Fermer le programme

## Jeu du serpent POO
- Reprendre le principe de base du jeu du Serpent (jeu de plateau) pour le faire en orienté objet.
- Vous devez avoir à minima deux classes :
    - Jeu / Game
    - Joueur / Player
- Chaque classe doit effectuer les opérations qui lui incombe.
- Le program.cs ne doit contenir qu'une instanciation de la classe Jeu / Game + Appel d'une méthode Start() (Donc uniquement deux lignes dans le program.cs, ou une pour ceux qui voient comment faire)
- Tout doit être fait en orienté objet
- Toutes les règles du jeu du serpent procédural doivent être reprises (Si dépasse la case max, retourne à case max / 2, cases pièges / bonus, si un joueur arrive à la case final, il doit être proclamé comme vainqueur, les joueurs jouent au tour par tour)
- Bonus à implémenter pour bien pratiquer :
    - Le nombre de case du plateau doit être entré par l'utilisateur soit 50, soit 100, soit 200
    - Le nombre de joueur est décidé au début de la partie (entre 2 et 4 joueurs)
    - Case pièges / bonus à adapter en fonction de la taille du plateau