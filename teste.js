objeto = {
  "responde": [
    {
      "id": "1",
      "first_name": "Vinicius",
      "last_name": "resende",
      "email": "pires@gmail.com"
    },
    {
      "id": "2",
      "first_name": "Vinicius",
      "last_name": "resende",
      "email": "pires@gmail.com"
    },
    {
      "id": "3",
      "first_name": "Vinicius",
      "last_name": "resende",
      "email": "pires@gmail.com"
    },
    {
      "id": "4",
      "first_name": "Vinicius",
      "last_name": "resende",
      "email": "pires@gmail.com"
    },
]}

var arrayJson = JSON.parse(objeto);
arrayJson.forEach(function(responde){
  console.log(responde)
})