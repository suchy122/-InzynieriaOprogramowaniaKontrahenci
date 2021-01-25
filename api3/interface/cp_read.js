function fetchData(){
    fetch('https://kontr.herokuapp.com/product/readcp.php')
        .then(response => {
            if (!response.ok){
                throw Error('ERROR');
            }
            return response.json();
        })
        .then(data => {
        console.log(data);
            const html = data.records
            .map(osoby_kontaktowe => {
                return `
                <div class="tlo">
                <div class="osoby_kontaktowe">
                    <p><b>ID osoby kontaktowej:</b> ${osoby_kontaktowe.ID_osoby_kontaktowej}</p>
                    <p><b>ID siedziby:</b> ${osoby_kontaktowe.ID_siedziby}</p>
                    <p><b>Imie:</b> ${osoby_kontaktowe.Imie}</p>
                    <p><b>Nazwisko:</b> ${osoby_kontaktowe.Nazwisko}</p>
                    <p><b>Telefon:</b> ${osoby_kontaktowe.Telefon}</p>
                    <p><b>Opis:</b> ${osoby_kontaktowe.Opis}</p>
                    <p><b>Adres:</b> ${osoby_kontaktowe.Adres}</p>
                </div>
                <div class="guzik">
                        <button type="button" name="submit" class="btn btn-primary" value="Edytuj" onclick="edycja('${osoby_kontaktowe.ID_osoby_kontaktowej}','${osoby_kontaktowe.ID_siedziby}','${osoby_kontaktowe.Imie}','${osoby_kontaktowe.Nazwisko}','${osoby_kontaktowe.Telefon}','${osoby_kontaktowe.Opis}','${osoby_kontaktowe.Adres}')" >Edytuj</button>
                    </div>
                    <div class="guzik2">
                        <button type="button" name="submit" class="btn btn-primary" value="Usuń" onclick="remove('${osoby_kontaktowe.ID_osoby_kontaktowej}')" >Usuń</button>
                    </div>
                </div>
                `;
            })
            .join("");
            document.querySelector("#app").insertAdjacentHTML("afterbegin", html);
        })
        .catch(error => {
            console.log(error);
        });
}
fetchData();

function edycja(ID_osoby_kontaktowej, ID_siedziby, Imie, Nazwisko, Telefon, Opis, Adres) {
    localStorage.setItem('ID_osoby_kontaktowej', ID_osoby_kontaktowej);
    localStorage.setItem('ID_siedziby', ID_siedziby);
    localStorage.setItem('Imie', Imie);
    localStorage.setItem('Nazwisko', Nazwisko);
    localStorage.setItem('Telefon', Telefon);
    localStorage.setItem('Opis', Opis);
    localStorage.setItem('Adres', Adres);
    window.location = "https://kontr.herokuapp.com/interface/cp_edit.html";
 }

function remove(ID_osoby_kontaktowej) {
    const obj = {
        ID_osoby_kontaktowej: ID_osoby_kontaktowej
      }
      deleteData(obj);
      window.location.reload(true);
}

 function deleteData(obj)
{
    fetch('https://kontr.herokuapp.com/product/deletecp.php', {
    method: "DELETE",
    headers: {
    "Accept": "application/json",
    "Content-Type": "application/json"
    },
    body: JSON.stringify(obj)
    })
    .then(response => {
    if (!response.ok){
    throw Error('ERROR');
    }
    return response.json();
    })
    .then(data => {
    console.log(data);  
    })
    .catch(error => {
    console.log(error);
 
    });
}