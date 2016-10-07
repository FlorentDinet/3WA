var annee = [
    ["janvier", 31],
    ["fevrier", 29],
    ["mars", 31],
    ["avril", 31],
    ["mai", 31],
    ["juin", 31],
    ["juillet", 31],
    ["aout", 31],
    ["septembre", 31],
    ["octobre", 31],
    ["novembre", 31],
    ["decembre", 31]
];

console.log(annee[10] + annee[11] + annee[0] + annee[1] + annee[2]);
annee[11][0] = "Mois de Noël";
console.log(annee.length);

annee.every(function(element) {

    return !isNaN(element);
});

for (var mois in annee) {
    console.log(annee[mois]);
}

// annee.map(function(num) {
//     return num * num;
// });


// var temp = annee[3];
// annee[3] = annee[2];
// annee[2] = temp;

annee.splice(2, 2, annee[3], annee[2]);

annee.forEach(function(element) {
    console.log(element);
});

annee.filter(function(element) {

    return element[1] === 31;
});

console.log(annee);
