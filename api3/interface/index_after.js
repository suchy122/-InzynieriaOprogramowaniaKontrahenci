function fetchData(NIP){

    fetch('https://kontr.herokuapp.com/product/read_one.php?NIP=' + NIP)
        .then(response =>  response.json())
        .then(data => {
            let inaczej =  "<div class='kontrahenci'><p><b>Nazwa: </b>" + data.Nazwa + "</p><p><b>NIP: </b>" + data.NIP + "</p><p><b>Bank: </b>" + data.Bank + "</p></div>";
            document.querySelector("#app").innerHTML=inaczej;
             //console.log(inaczej);
            }).catch(error => {
              console.log("testowy log xd ");
              alert("Podaj poprawny NIP");
              window.location = "https://kontr.herokuapp.com/interface/index.html";
            });
}

function aaadane(NIP){
    $.getJSON("faktury.json", function (json) {
        function findId(json, idToLookFor) {
          var categoryArray = json;
          var inaczej = "";
          var inaczej2 = '<table class="table"><thead><tr><th scope="col">Id</th><th scope="col">Data płatności</th><th scope="col">NIP</th><th scope="col">Numer faktury</th><th scope="col">Status</th><th scope="col">Wartość faktury brutto</th></tr></thead><tbody>';
          var inaczej3 = "";
          var inaczej4 = "";
          var sumaOplacony = 0;
          var sumaNieOplacony = 0;
          var ilosc = 0;
          for (var i = 0; i < categoryArray.length; i++) {
            if (categoryArray[i].NIP == idToLookFor) {
                inaczej2 += '<tr><th scope="row">' + categoryArray[i].Id + '</th><td>' + categoryArray[i].Data_platnosci + '</td><td>' + categoryArray[i].NIP + '</td><td>' + categoryArray[i].Numer_faktury + '</td><td>' + categoryArray[i].Status + '</td><td>' + categoryArray[i].Wartosc_faktury_brutto + ' zł</td><td>';
                
                if (categoryArray[i].Status == "OPLACONA"){
                    sumaOplacony += categoryArray[i].Wartosc_faktury_brutto;
                } else {
                  sumaNieOplacony += categoryArray[i].Wartosc_faktury_brutto;
                }
                ilosc ++;
            }
          }
          inaczej2 += '<tr><td colspan="4"></td><th scope="row">Suma opłaconych</th><td>'+sumaOplacony+' zł</td></tr><tr><td colspan="4"><th scope="row">Suma nieopłaconych</th><td>'+sumaNieOplacony+' zł</td><tr><tr><td colspan="4"><th scope="row">Ilość faktur</th><td>'+ilosc+'</td></tr></tbody></table>';
          document.querySelector("#app2").innerHTML=inaczej2;
        }

        findId(json, NIP);
      });
}
