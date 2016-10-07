var randomNumber = 0;
var playerChoice = 0;


function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function askPlayerChoice() {

    playerChoice = parseInt(prompt("deviner ce nombre aléatoire entre 1 et 15"));
    while (!(testerNoteCorrecte(note))) {
        playerChoice = parseInt(prompt("Merci d'entrer un nombre entre 1 et 15"));
    }

    return playerChoice;
}

function testerNoteCorrecte(note) {

    if (isNaN(parseFloat(note)) || note > 20 || note < 0) {
        affiche("note invalide " + note);

        return false;
    } else {
        affiche("note valide " + note);

        return true;
    }
}

function compareNumbers(num1, num2) {
    if (num1 === num2) {

        return true;
    } else {

        return false;
    }
}

randomNumber = getRandomIntInclusive(1, 15);
console.log("Le numéro à découvrir est " + randomNumber);
playerChoice = askPlayerChoice();
console.log("Le joueur a choisi " + playerChoice);

console.log(compareNumbers(randomNumber, playerChoice));
