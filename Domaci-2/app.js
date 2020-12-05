// niz objekata od kojih svaki predstavlja jedno pitanje
// u realnoj aplikaciji, dobili bi ga u JSON formatu (AJAX pozivom ka serveru)
const pitanja = [
    {
      // tekst pitanja
      pitanje: "Ko je osnivač kompanije <em>Apple</em>?", 
      // ponudjeni odgovori
      odgovori: {
        a: "Bil Gejts",
        b: "Ilon Maks",
        c: "Stiv Džobs"
      },
      // koji on ponudjenih odgovora je tacan
      tacanOdgovor: "c"
    },
    {
      pitanje: "Kako se zvala prva programerka? Jedan progamski jezik nosi njeno ime.",
      odgovori: {
        a: "Ada Bajron",
        b: "Karmen Elektra",
        c: "Java Script"
      },
      tacanOdgovor: "a"
    },
    {
      pitanje: "Kako se zove čuveni naučnik o kome govori film <em>The Immitation Game</em> ",
      odgovori: {
        a: "Nikola Tesla",
        b: "Alen Tjuring",
        c: "Tomas Edison"
      },
      tacanOdgovor: "b"
    },
    {
      pitanje: "9*8+11 = ? ",
      odgovori: {
        a: "83",
        b: "86",
        c: "91"
      },
      tacanOdgovor: "a"
    },
    {
      pitanje: "Najveci vodopad je ",
      odgovori: {
        a: "Igazu vodopadi",
        b: "Viktorijini vodopadi",
        c: "Anđeoski vodopadi"
      },
      tacanOdgovor: "c"
    },
    {
      pitanje: "Akronim PC oznacava ",
      odgovori: {
        a: "Private Computer",
        b: "Personal Computer",
        c: "Personal Compact"
      },
      tacanOdgovor: "b"
    }
];

const kvizDiv = document.getElementById('kviz'); // div za prikaz pitanja i ponudjenih odgovora
const rezultatDiv = document.getElementById('rezultat'); // div za prikaz rezultata
const zavrsiBtn = document.getElementById('zavrsi'); // dugme za zavrsavanje kviza

// metod koji se poziva da bi se prikazala pitanja i ponudjeni odgovori
function pokreniKviz(){
  // niz koji popunjavamo tekstom pitanja i ponudjenim odgovorima
  // niz ce sadrzati HTML elemente
  const output = [];

  // prolazimo petljom kroz sve elemente niza pitanja
  // uzimamo pitanje koje je aktuelno u trenutnoj iteraciji i njegov indeks
  pitanja.forEach(function(trenutnoPitanje, pitanjeInd){
    // niz koji cemo popuniti odgovorima na trenutno pitanje
    const odgovori = []; 
    // petlja koja prolazi svim odgovorima trenutnog pitanja
    for(slovo in trenutnoPitanje.odgovori){
      // u niz odgovora dodajemo HTML kod za prikaz ponudjenog odgovora
      // inputi za odgovor na isto pitanje moraju imati isti name atribut
      // odradjujemo da svaki od njih ima name="odogovor"+indeks_trenutnog_pitanja
      // na taj nacin ce svi ponudjeni odgovori na pitanje sa indeksom 1 imati name="odgovor1"
      // vrijednost odgovora je upravo ono slovo pod kojim je on i ponudjen
      // tekst je oblika: " a : tekst_odgovora "
      odgovori.push(
        `<label>
          <input type="radio" name="odgovor${pitanjeInd}" value="${slovo}" >
          ${slovo} : ${trenutnoPitanje.odgovori[slovo]}
          </label>`
      );
    }

    // na kraju u output niz koji sadrzi sva pitanja i ponudjene odgovore dodajemo trenutno
    // trenutnoPitanje.pitanje je tekst pitanja
    // funkcija join od niza pravi string
    output.push(
      `
        <div class="pitanje-${pitanjeInd}">${pitanjeInd+1 }. ${trenutnoPitanje.pitanje}</div>
        <div class="odgovori"> ${odgovori.join('')} </div>
      `
    );

  });
  // na kraju popunjavamo div za prikaz pitanja i odgovora
  kvizDiv.innerHTML = output.join('');
}

// funkcija koja se poziva na klik dugmeta za zavrsavanje kviza
// provjerava koliko je igrac imao tacnih odgovora
function prikaziRezultat(){
  // na samom pocetku nije imao tacnih odgovora
  let brTacnih = 0;

  // prolazimo kroz globalni niz svih pitanja
  // tu poredimo odgovor koji je igrac dao na to pitanja sa tacnim odgovorom pitanja 
  pitanja.forEach(function(trenutnoPitanje, pitanjeInd){
    // selektor koji trazi cekirani input na trenutno pitanje
    const selektor = `input[name=odgovor${pitanjeInd}]:checked`;
    // igrac je odgovorio ono sto je vrijednost cekiranog input-a (radio button-a)
    const odgovoreno = (document.querySelector(selektor) || {} ).value;
    const pitanjeSelektor = document.querySelector(".pitanje-" + pitanjeInd); // selektor trenutnog pitanja

    // ako je ono sto je igrac odgovorio jednako tacnom odgovoru na trenutno pitanje
    // to znaci da je igrac tacno odgovorio i povecavamo ukupan broj tacnih odgovora
    if(odgovoreno === trenutnoPitanje.tacanOdgovor){
      brTacnih++;
      pitanjeSelektor.classList.add('tacanOdg');
    } else {
      pitanjeSelektor.classList.add('pogresanOdg');
    }
  });
  // na kraju samo popunjavamo div za prikaz rezultata
  rezultatDiv.innerHTML = `rezultat: <h3>${brTacnih} od ${pitanja.length}</h3>`;
let tajmer = document.getElementById('tajmer');
tajmer.style.display = 'none'; // sakrijemo tajmer sa stranice
vrijeme = 0; // iskljucujemo tajmer da ne bi radio u pozadini
}

var vrijeme = 60;
    function Tajmer() {
        var brojac = document.getElementById("tajmer");
        brojac.innerHTML = vrijeme + ' sekundi preostalo';
        vrijeme--;
        if( vrijeme >= 0 ) {
            setTimeout(Tajmer, 1000);
        } else {
            prikaziRezultat();
        }
}

// na ucitavanje stranice, pozivamo metod za prikaz(pocetak) kviza
pokreniKviz();
Tajmer();
// na dugme za zavrsavanje dodajemo listener koji na klik pokrece kraj kviz i racuna ucinak
zavrsiBtn.addEventListener('click', prikaziRezultat);


/* DOMACI ZADATAK 2 */
// 1. tekst pitanja dobija crvenu(ako je korisnik odgovorio netacno) 
// ili zelenu (ako je korisnik odgovorio tacno) boju
// 2. postaviti tajmer da se automatski zavrsi kviz nakon 60 sekundi