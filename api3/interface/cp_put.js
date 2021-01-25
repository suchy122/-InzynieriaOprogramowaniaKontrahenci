function postData(obj)
{
    fetch('https://kontr.herokuapp.com/product/updatecp.php', {
    method: "PUT",
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