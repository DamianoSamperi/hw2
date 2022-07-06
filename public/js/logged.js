var session_username=document.getElementById('session');
session_username=session_username.innerText;
function MostraRicerca(event){
    const form=document.querySelector("form#Ricerca");
    form.classList.remove("Hidden");
    form.addEventListener("submit",Ricerca);
    event.currentTarget.addEventListener("click",NascondiRicerca);
    event.currentTarget.removeEventListener("click",MostraRicerca);
}
function NascondiRicerca(event){
    const Ricerca=document.querySelector("form");
    Ricerca.classList.add("Hidden");
    event.currentTarget.removeEventListener("click",NascondiRicerca);
    event.currentTarget.addEventListener("click",MostraRicerca);
}
function MostraPreferiti(event){
    const nuova_ricetta=document.querySelector(".nuova_vista");
    nuova_ricetta.classList.remove("Hidden");
    event.currentTarget.removeEventListener("click",MostraPreferiti);
    event.currentTarget.addEventListener("click",NascondiPreferiti);
    const prova=document.querySelector('.prova');
    prova.classList.add('Hidden');
}
function NascondiPreferiti(event){
    event.currentTarget.addEventListener("click",MostraPreferiti);
    event.currentTarget.removeEventListener("click",NascondiPreferiti);
    const nuova_ricetta=document.querySelector(".nuova_vista");
    nuova_ricetta.classList.add("Hidden");
}
function Mostra_Creazioni(event){
    const nuova_vista=document.querySelector(".creati");
    nuova_vista.classList.remove("Hidden");
    event.currentTarget.removeEventListener("click",Mostra_Creazioni);
    event.currentTarget.addEventListener("click",Nascondi_Creazioni);
    const prova=document.querySelector('.prova');
    prova.classList.add('Hidden');
}
function Nascondi_Creazioni(event){
    event.currentTarget.addEventListener("click",Mostra_Creazioni);
    event.currentTarget.removeEventListener("click",Nascondi_Creazioni);
    const nuova_vista=document.querySelector(".creati");
    nuova_vista.classList.add("Hidden");
}
function mostra_form_creazioni(event){
    const form=document.querySelector('#Crea_ricetta');
    form.classList.remove('Hidden');
    event.currentTarget.addEventListener("click",nascondi_form_creazioni);
    event.currentTarget.removeEventListener("click",mostra_form_creazioni);
}
function nascondi_form_creazioni(event){
    const form=document.querySelector('#Crea_ricetta');
    form.classList.add('Hidden');
    event.currentTarget.removeEventListener("click",nascondi_form_creazioni);
    event.currentTarget.addEventListener("click",mostra_form_creazioni);
}
function OnResponse(response){
 return response.json();
}
function OnJson(json){
    const titolo_ricetta=document.querySelector("#titolo");
    const nuova_ricetta=document.querySelector(".nuova_vista");
    const sezione_preferiti=document.querySelector(".mostra_preferiti");
    if(json.count!=0){
    titolo_ricetta.textContent="Risultati Ricerca";
    nuova_ricetta.innerHTML='';
    nuova_ricetta.classList.remove("Hidden");
    sezione_preferiti.classList.add("Hidden");
    for(let i=0;i<2;i++){
       const hit=json.hits[i];
       const titolo=hit.recipe.label;
       const ingredienti=hit.recipe.ingredients;
       const img=hit.recipe.images.REGULAR.url;

       const contenuto=document.createElement("div");
       contenuto.classList.add("contenuto");
       
       const title=document.createElement("div");
       title.textContent=titolo;
       title.classList.add('title');
       const Box1=document.createElement("div");
       Box1.classList.add("Box1");
       
       const immagine=document.createElement("img");
       immagine.src=img;
       immagine.classList.add('Json');
       const Box2=document.createElement("div");
       Box2.classList.add("Box2");
       
       for(let p=0;p<ingredienti.length;p++){
           Box2.innerHTML=Box2.innerHTML+ingredienti[p].text+"<br/>";
       }
       
       Box1.appendChild(title);
       Box1.appendChild(immagine);
       contenuto.appendChild(Box1);
       contenuto.appendChild(Box2);
       const preferito=document.createElement('img');
       preferito.id=i;
       contenuto.appendChild(preferito);
       const section=document.createElement("section");
       section.appendChild(contenuto);
       section.classList.add("Item");
       nuova_ricetta.appendChild(section);
       id_ricetta=hit._links.self.href;
       id_ricetta=id_ricetta.slice(38,70);
       preferito.classList.add(id_ricetta);
       fetch('/preferito/verifica/'+encodeURIComponent(i)+'/'+encodeURIComponent(id_ricetta)).then(OnResponse).then(Verifica);
       preferito.addEventListener('click',function (json){ return Preferito(preferito); });

       butt=document.querySelector("#Ritorna");
       butt.classList.remove("Hidden");
       butt.addEventListener("click",torna);
       
    }
    }else{
        nuova_ricetta.innerHTML='';
        nuova_ricetta.textContent="Nessuna ricetta trovata con quel nome, prova con titoli più generali es.'torta' o 'nutella'";
    }
    const mostra_creati=document.querySelector(".mostra_creati");
    mostra_creati.classList.add("Hidden");
    const sezione_creati=document.querySelector(".creati");
    sezione_creati.classList.add("Hidden"); 
    
}
function OnJson_carica(json){
    const nuova_ricetta=document.querySelector(".nuova_vista");
    if(json){
    nuova_ricetta.innerHTML='';
    for(let i=0;i<json.length;i++){
        js=json[i][0];
       const titolo=js.recipe.label;
       const ingredienti=js.recipe.ingredients;
       const img=js.recipe.images.REGULAR.url;
       const contenuto=document.createElement("div");
       contenuto.classList.add("contenuto");
       
       const title=document.createElement("div");
       title.textContent=titolo;
       title.classList.add('title');

       const Box1=document.createElement("div");
       Box1.classList.add("Box1");
       
       const immagine=document.createElement("img");
       immagine.src=img;
       immagine.classList.add('Json');
       const Box2=document.createElement("div");
       Box2.classList.add("Box2");
       for(let p=0;p<ingredienti.length;p++){
        Box2.innerHTML=Box2.innerHTML+ingredienti[p].text+"<br/>";
    }
      
       Box1.appendChild(title);
       Box1.appendChild(immagine);
       contenuto.appendChild(Box1);
       contenuto.appendChild(Box2);
       const preferito=document.createElement('img');
       preferito.id=i;
       contenuto.appendChild(preferito);
       const section=document.createElement("section");
       section.classList.add("Item");
       section.appendChild(contenuto);
       nuova_ricetta.appendChild(section);
       id_ricetta=js._links.self.href;
       id_ricetta=id_ricetta.slice(38,70);
       preferito.classList.add(id_ricetta);
       fetch('/preferito/verifica/'+encodeURIComponent(i)+'/'+encodeURIComponent(id_ricetta)).then(OnResponse).then(Verifica);

       preferito.addEventListener('click',function (json){ return Preferito_e_ricarica(preferito); });
    }}else{
    nuova_ricetta.innerHTML='';
    nuova_ricetta.textContent="Non hai preferiti salvati";
    }
    fetch("/creazione/carica/"+encodeURIComponent(true)).then(OnResponse).then(Carica_creati);
}
function Carica_creati(json){
    const nuova_ricetta=document.querySelector(".creati");
    const creati=document.querySelector("#inserimento");
    creati.innerHTML='';
    if(json){
    for(let i=0;i<json.length;i++){
       const titolo=json[i].label;
       const preparazione=json[i].box;
       const img=json[i].img;

       const contenuto=document.createElement("div");
       contenuto.classList.add("contenuto_creato");
       
       const title=document.createElement("div");
       title.textContent=titolo;
       
       const Box1=document.createElement("div");
       Box1.classList.add("Box1");
       
       const immagine=document.createElement("img");
       immagine.src=img;
       immagine.classList.add("Regular");
       
       const Box2=document.createElement("div");
       Box2.classList.add("Box2");
       Box2.innerHTML=preparazione;
      
       Box1.appendChild(title);
       Box1.appendChild(immagine);
       contenuto.appendChild(Box1);
       contenuto.appendChild(Box2);
       const cestino=document.createElement('img');
       cestino.src="cestino.png";
       const section=document.createElement("section");
       section.classList.add("Item");
       section.appendChild(contenuto);
       section.appendChild(cestino);
       creati.appendChild(section);
       nuova_ricetta.appendChild(creati);

       cestino.addEventListener('click',function (json){ return Cancella(cestino); });
       
    }}
    // else{
    //     creati.textContent='Ancora nessun elemento creato';
    // }
}
function Verifica(json){
    const preferito= document.getElementById(json['preferito']);
    if(json['entry'])
    {
        preferito.src="favorite.png";
    }
    else{
        preferito.src="not_favorite.png";
    }
}
function Cancella(cestino){
    id=cestino.parentNode.querySelector(".Box1 div").innerHTML;
    fetch('/creazione/cancella/'+encodeURIComponent(id)).then(Ricarica);
}
function Elimina(){
    fetch('/home/cancella/').then(Ricarica);
}
function Preferito(preferito){
    id=preferito.className;
    fetch('/preferito/modifica/'+encodeURIComponent(preferito.id)+'/'+encodeURIComponent(id)).then(OnResponse).then(VerificaPreferito);
}
function Preferito_e_ricarica(preferito){
    id=preferito.className;
    fetch('/preferito/modifica/'+encodeURIComponent(preferito.id)+'/'+encodeURIComponent(id)).then(OnResponse).then(VerificaPreferito).then(Ricarica);
}
function VerificaPreferito(json){
    const preferito= document.getElementById(json['preferito']);
    if(!json['entry']){
        preferito.src="favorite.png";
    }else{
        preferito.src="not_favorite.png";
    }
}
function torna(event){
    location.href = '/';
}
function Ricerca(event){
    event.preventDefault();
    section_descrizione=document.querySelector('.Descrizione');

    const prova=document.querySelector('.prova');
    prova.classList.add('Hidden');
    const input=document.querySelector("#ricetta");
    const value=encodeURIComponent(input.value);
    const utente=document.querySelector("#scelta");
    if(value!=""){
      if(utente.value=="rc"){
        section_descrizione.classList.add('Hidden');
        fetch('/ricerca/'+encodeURIComponent(value)).then(OnResponse).then(OnJson);
        fetch('/ricercaSpotify').then(OnResponse).then(JsonMostraAlbum);
      }
      else{
        section_descrizione.classList.remove('Hidden');
        fetch('/ricerca/utente/'+encodeURIComponent(value)).then(OnResponse).then(OnJson_carica_utente);
        butt=document.querySelector("#Ritorna");
        butt.classList.remove("Hidden");
        butt.addEventListener("click",torna);
      }
    
}
}
function OnJson_carica_utente(json){
    const nuova_ricetta=document.querySelector(".nuova_vista");
    nuova_ricetta.classList.remove('Hidden');
    nuova_ricetta.innerHTML='';
    const titolo_ricetta=document.querySelector("#titolo");
    if(!json[1]){
        titolo_ricetta.textContent="Utente non trovato ";
        const sezione_spotify=document.querySelector(".Spotify");
        sezione_spotify.classList.add("Hidden");

        const container=document.querySelector(".Descrizione span");
        container.innerHTML='';
    }else{

    const sezione_preferiti=document.querySelector(".mostra_preferiti");
    sezione_preferiti.classList.add("Hidden");
    
    const input=document.querySelector("#ricetta");
    titolo_ricetta.textContent="Pagina personale utente: "+ input.value;
    if(json[0]){
    for(let i=0;i<json[0][0].length;i++){
       js=json[0][0][i];
       const titolo=js.recipe.label;
       const ingredienti=js.recipe.ingredients;
       const img=js.recipe.images.REGULAR.url;

       const contenuto=document.createElement("div");
       contenuto.classList.add("contenuto");
       
       const title=document.createElement("div");
       title.textContent=titolo;
       title.classList.add('title');
       const Box1=document.createElement("div");
       Box1.classList.add("Box1");
       
       const immagine=document.createElement("img");
       immagine.src=img;
       immagine.classList.add('Json');
       const Box2=document.createElement("div");
       Box2.classList.add("Box2");
       for(let p=0;p<ingredienti.length;p++){
        Box2.innerHTML=Box2.innerHTML+ingredienti[p].text+"<br/>";
        }    

    Box1.appendChild(title);
    Box1.appendChild(immagine);
    contenuto.appendChild(Box1);
    contenuto.appendChild(Box2);
    const preferito=document.createElement('img');
    preferito.id=i;
    contenuto.appendChild(preferito);
    const section=document.createElement("section");
    section.classList.add("Item");
    section.appendChild(contenuto);
    nuova_ricetta.appendChild(section);
    id_ricetta=js._links.self.href;
    id_ricetta=id_ricetta.slice(38,70);
    preferito.classList.add(id_ricetta);
    fetch('/preferito/verifica/'+encodeURIComponent(i)+'/'+encodeURIComponent(id_ricetta)).then(OnResponse).then(Verifica);

    preferito.addEventListener('click',function (json){ return Preferito(preferito); });
       
     }
    }else{
        nuova_ricetta.textContent="L'utente non ha preferiti salvati"
    }
    fetch('/descrizione').then(OnResponse).then(function (json){ return MongoDb_carica_descrizione(json,input.value); });
    fetch("/creazione/carica/"+encodeURIComponent(input.value)).then(OnResponse).then(Carica_creati);
    const mostra_creati=document.querySelector(".mostra_creati");
    mostra_creati.classList.add("Hidden");
    const sezione_creati=document.querySelector(".creati");
    const add_creati=document.querySelector(".creati img");
    sezione_creati.classList.remove("Hidden");  
    add_creati.classList.add("Hidden");
}
}
function JsonMostraAlbum(json){
    const nuova_ricetta=document.querySelector(".Spotify");
    nuova_ricetta.classList.remove("Hidden");
    const Box1=document.createElement("div");
    Box1.classList.add("Box1");
    Box1.innerHTML="Ti consiglio questo artista raccomandato durante la prepazione <br/>";
    const immagine=document.createElement("img");
          immagine.src=json.albums.items[0].images[1].url;
    const a=document.createElement("a");
          a.href=json.albums.items[0].artists[0].external_urls.spotify;
    a.appendChild(immagine);
    Box1.appendChild(a);
    nuova_ricetta.innerHTML="";
    nuova_ricetta.appendChild(Box1);
}
function Inizializza(){
    const sezione_preferiti=document.querySelector(".mostra_preferiti");
    const mostra_preferito=document.createElement("img");
    sezione_preferiti.appendChild(mostra_preferito); 
    mostra_preferito.src="mostra_preferiti.png";
    mostra_preferito.addEventListener("click",MostraPreferiti);

    const sezione_creati=document.querySelector(".mostra_creati");
    const mostra_creazioni=document.createElement("img");
    sezione_creati.appendChild(mostra_creazioni);
    mostra_creazioni.src="mostra_creazioni.png";
    mostra_creazioni.addEventListener("click",Mostra_Creazioni);

    const sezione_creazioni=document.querySelector(".creati");
    const add_creati=document.createElement("img");
    sezione_creazioni.appendChild(add_creati);
    add_creati.src="add.png";
    add_creati.addEventListener("click",mostra_form_creazioni);

    const nuova_ricetta=document.querySelector(".nuova_vista");
    nuova_ricetta.classList.add("Hidden");

    const Vista_Spotify=document.querySelector(".Spotify");
    Vista_Spotify.classList.add("Hidden");

    sezione_creazioni.classList.add("Hidden");

    const menu=document.querySelector('#menu');
    menu.addEventListener("click",MostraLink);
}
function MongoDb_carica_descrizione(json,username){
    form=document.getElementById('Crea_descrizione');
    var hit="Nessuna descrizione salvata";
    const nuova_descrizione=document.querySelector(".Descrizione");
    const Box=document.createElement("span");
    const container=document.querySelector(".Descrizione span");
    container.innerHTML='';
for(let i=0;i<json.length;i++){
    if(json[i].username==username){
    hit=json[i].testo;
    form.classList.add("Hidden");
    
    if(json[i].username==session_username){
     const elimina=document.createElement('img');
     elimina.src="cancella.png";
     container.appendChild(elimina);
     elimina.addEventListener("click",Elimina);
    }
    
    }
}
   if(hit=="Nessuna descrizione salvata"&&username==session_username){
    form.classList.remove('Hidden');
   }
   else{
    Box.classList.add("Descrizione");
    Box.innerText=hit;
    container.appendChild(Box);
    nuova_descrizione.appendChild(container);
   }
}
function MostraLink(event){
    link=document.querySelector('#link');
    link.classList.add('links-mobile');
    link.classList.remove('links');
    event.currentTarget.addEventListener('click',NascondiLink);
    event.currentTarget.removeEventListener('click',MostraLink);
}
function NascondiLink(event){
    link=document.querySelector('#link');
    link.classList.add('links');
    link.classList.remove('links-mobile');
    event.currentTarget.addEventListener('click',MostraLink);
    event.currentTarget.removeEventListener('click',NascondiLink);
}
function Ricarica(){
    fetch('/carica/home').then(OnResponse).then(OnJson_carica);
    fetch('/descrizione').then(OnResponse).then(function (json){ return MongoDb_carica_descrizione(json,session_username); });
}
const Cerca = document.querySelector('a#Ricerca.button');
Cerca.addEventListener("click",MostraRicerca);

Inizializza();
Ricarica();