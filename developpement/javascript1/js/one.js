// on définit les variables

var message = "";

var notes = [];

// on définit les fonctions

// on affiche les messages
function affiche(message) {
    console.log(message);
}

// on demande les 8 notes
function demanderNotes() {

    for (var i = 0; i < 8; i++) {

        note = prompt("Quelles sont vos notes du BAC ?");
        while (!(testerNoteCorrecte(note))) {
            note = prompt("Merci d'entrer un nombre entre 0 et 20");
        }
        notes.push(Number(note));
    }

    return notes;
}

// on teste si les notes entrées sont valides
function testerNoteCorrecte(note) {

    if (isNaN(parseFloat(note)) || note > 20 || note < 0) {
        affiche("note invalide " + note);

        return false;
    } else {
        affiche("note valide " + note);

        return true;
    }
}

// on calcule la moyenne de nombres stockés dans un tableau
function quelleMoyenne(arr) {
    affiche(arr);

    var nombreDeNote = arr.length;
    var somme = 0;
    var compteLesNotesEgales = 0;

    // on parcour le tableau en testant l'égalité entre les notes
    for (var y = 0, j = arr.length; y < j; y++) {
        if (arr[y] === arr[0]) {
            compteLesNotesEgales++;
            affiche("je compte les notes égales : " + compteLesNotesEgales);
        }
        if (compteLesNotesEgales == j) {
            affiche("Vous etes super constant !");
        }
    }

    for (var i = 0; i < j; i++) {
        somme += arr[i];
    }


    affiche("La moyenne est " + somme / arr.length);
    return somme / arr.length;
}

// on determine une mention en fonction d'une note de 0 à 20
function quelleMention(moyenne) {
    affiche("La mention pour la note : " + moyenne);
    if (moyenne === 0) {
        console.log("Vous êtes éliminé");
    } else if (moyenne < 10) {
        console.log("Vous êtes en rattrapage");
    } else if (moyenne < 12) {
        console.log("Vous avez eu la mention assez bien");
    } else if (moyenne < 16) {
        console.log("Vous avez eu la mention bien");
    } else if (moyenne < 18) {
        console.log("Vous avez eu la mention très bien");
    } else if (moyenne <= 20) {
        console.log("Bravo, vous avez les félicitations du jury");
    } else {

    }
}

// ON AGIT

// quelleMention(prompt("Qu'elle est votre note du BAC ?"));

//quelleMoyenne(prompt("Qu'elles sont vos notes du BAC ?"));

quelleMention(quelleMoyenne(demanderNotes()));
