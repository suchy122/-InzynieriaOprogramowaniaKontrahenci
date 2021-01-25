function fetchData(){
    fetch('https://kontr.herokuapp.com/product/read.php')
        .then(response => {
            if (!response.ok){
                throw Error('ERROR');
            }
            return response.json();
        })
        .then(data => {
        console.log(data);
            const html = data.records
            .map(kontrahenci => {
                return `
                
                <div class="tlo">
                    <div class="kontrahenci">
                        <p><b>Nazwa:</b> ${kontrahenci.Nazwa}</p>
                        <p><b>NIP:</b> ${kontrahenci.NIP}</p>
                        <p><b>Bank:</b> ${kontrahenci.Bank}</p>
                    </div>
                    <div class="guzik">
                        <button type="button" name="submit" class="btn btn-primary" value="Edytuj" onclick="edycja('${kontrahenci.ID_kontrahenta}','${kontrahenci.Nazwa}','${kontrahenci.NIP}','${kontrahenci.Bank}')" >Edytuj</button>
                    </div>
                    <div class="guzik2">
                        <button type="button" name="submit" class="btn btn-primary" value="Usuń" onclick="remove('${kontrahenci.NIP}')" >Usuń</button>
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

 function edycja(ID_kontrahenta, Nazwa, NIP, Bank) {
    localStorage.setItem('ID_kontrahenta', ID_kontrahenta);
    localStorage.setItem('Nazwa', Nazwa);
    localStorage.setItem('NIP', NIP);
    localStorage.setItem('Bank', Bank);
    window.location = "https://kontr.herokuapp.com/interface/con_edit.html";
 }

function remove(NIP) {
    const obj = {
        NIP: NIP
      }
      deleteData(obj);
      window.location.reload(true);
}

 function deleteData(obj)
{
    fetch('https://kontr.herokuapp.com/product/delete.php', {
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