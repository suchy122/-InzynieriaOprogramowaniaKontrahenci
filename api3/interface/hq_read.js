function fetchData(){
    fetch('https://kontr.herokuapp.com/product/readhq.php')
        .then(response => {
            if (!response.ok){
                throw Error('ERROR');
            }
            return response.json();
        })
        .then(data => {
        console.log(data);
            const html = data.records
            .map(siedziby => {
                return `
                <div class="tlo">
                <div class="siedziby">
                    <p><b>ID siedziby:</b> ${siedziby.ID_siedziby}</p>
                    <p><b>NIP kontrahenta:</b> ${siedziby.NIP}</p>
                    <p><b>Miasto:</b> ${siedziby.Miasto}</p>
                    <p><b>Fax:</b> ${siedziby.Fax}</p>
                    <p><b>Mail:</b> ${siedziby.Mail}</p>
                    <p><b>Telefon:</b> ${siedziby.Telefon}</p>
                    <p><b>Kod pocztowy:</b> ${siedziby.Kod_pocztowy}</p>
                    <p><b>Numer_domu:</b> ${siedziby.Numer_domu}</p>
                    <p><b>Ulica:</b> ${siedziby.Ulica}</p>
                </div>
                <div class="guzik">
                        <button type="button" name="submit" class="btn btn-primary" value="Edytuj" 
                        onclick="edycja('${siedziby.ID_siedziby}','${siedziby.NIP}','${siedziby.Miasto}','${siedziby.Fax}'
                        ,'${siedziby.Mail}','${siedziby.Telefon}','${siedziby.Kod_pocztowy}','${siedziby.Numer_domu}','${siedziby.Ulica}')" >Edytuj
                        </button>
                    </div>
                    <div class="guzik2">
                        <button type="button" name="submit" class="btn btn-primary" value="Usuń" onclick="remove('${siedziby.ID_siedziby}')" >Usuń</button>
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

function edycja(ID_siedziby, NIP, Miasto, Fax, Mail, Telefon, Kod_pocztowy, Numer_domu, Ulica) {
    localStorage.setItem('ID_siedziby', ID_siedziby);
    localStorage.setItem('NIP', NIP);
    localStorage.setItem('Miasto', Miasto);
    localStorage.setItem('Fax', Fax);
    localStorage.setItem('Mail', Mail);
    localStorage.setItem('Telefon', Telefon);
    localStorage.setItem('Kod_pocztowy', Kod_pocztowy);
    localStorage.setItem('Numer_domu', Numer_domu);
    localStorage.setItem('Ulica', Ulica);
    window.location = "https://kontr.herokuapp.com/interface/hq_edit.html";
 }

 function remove(ID_siedziby) {
    const obj = {
        ID_siedziby: ID_siedziby
      }
      deleteData(obj);
      window.location.reload(true);
}

 function deleteData(obj)
{
    fetch('https://kontr.herokuapp.com/product/deletehq.php', {
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