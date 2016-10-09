var randomNumber = 0;
var playerChoice = 0;
var playerChoices = [];
var difficulty = 1;
var min = [1,1,1];
var max = [15,25,40];
var chances = [10,8,4];

// on génère un nombre aléatoire entre min et max inclus
function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// on demande au joueur de choisir un nombre avec gestion d'erreur de saisie
function askPlayerChoice() {

    playerChoice = parseInt(prompt("deviner ce nombre aléatoire entre " + min[difficulty-1] + " et " + max[difficulty-1]));
    console.log(playerChoice);

    while (!(testPlayerChoice(playerChoice))) {
        playerChoice = parseInt(prompt("Merci d'entrer un nombre entre " + min[difficulty-1] + " et " + max[difficulty-1]));
    }

    return playerChoice;

}

// on test la valdité du chois du joueur
function testPlayerChoice(choice) {

    if (isNaN(parseInt(choice)) || choice > max[difficulty-1] || choice < 0) {
        console.log(choice + " is an invalide choice");

        return false;
    } else {
        console.log(choice + " is a valide choice");

        return true;
    }
}

// on compare deux valeurs
function compareNumbers(num1, num2) {
    if (num1 === num2) {

        return true;
    } else {

        return false;
    }
}

// Moteur du jeu - on génère un nombre et on lance les demandes le bon nombre de fois puis on affiche le résultat
function game() {
    randomNumber = getRandomIntInclusive(min[difficulty-1], max[difficulty-1]); // on génère un nombre à deviner entre min et max en fonction de la difficulté
    console.log("Le numéro à découvrir est " + randomNumber);

    for (var i = 0; i < chances[difficulty-1]-1; i++) { // on va faire deviner un nombre de fois maximal défini par la difficulté
        if (i === chances[difficulty-1]-1) {
            alert("Vous avez perdu avec ces combinaisons : " + playerChoices + "\n Il fallait trouver " + randomNumber); // on affiche le message d'echec, les choix du joueur et la solution.
            break; // on casse la boucle puisque le jeu est terminé
        }
        playerChoice = askPlayerChoice(); // on demande son choix au joueur
        playerChoices.push(playerChoice); // on stocke le choix
        console.log("Le joueur a choisi " + playerChoices);
        if (compareNumbers(randomNumber, playerChoice)) { // on demande la comparaison du choix et de la solution
            alert("Vous avez gagné au bout de " + (Number(i) + 1) + " tentatives!"); // on affiche le message de réussite et le nombre de tentatives
            break; // on casse la boucle puisque le jeu est terminé
        } else if ((Math.abs(randomNumber - playerChoice)) <= 2) {
            alert("Vous êtes bouillant"); // on affiche le message que le joueur approche de la réponse
        }
        console.log(Math.abs(randomNumber - playerChoice));
    }
}

// on demande la difficulté et on la sauvegarde dans une variable qui servira à chercher les min max et chances de la partie
function askDifficulty() {
    difficulty = parseInt(prompt("Choisissez une difficulté 1, 2 ou 3 "));

    return;
}

function playAgain(){

}



game(askDifficulty());
