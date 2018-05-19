
// var key = sha1('5f609cca964f6bb6670d6d0b5eecbb83');
// console.log(key);

function getProducts() {
    return [
        '59333.jpg',
        '654000.jpg',
        '24563244.jpg'
    ];
}

function createImages() {
    var cont = 0;
    getProducts().forEach(element => {
        var img = document.createElement("img");
        img.setAttribute("src", "images/" + element);
        img.setAttribute("id", "image");
        img.setAttribute("alt", element);
        document.getElementById("images").appendChild(img);

        var p = document.createElement("p");
        p.setAttribute("id", "price" + cont);
        document.getElementById("images").appendChild(p);
        document.getElementById("price" + cont).innerHTML = element.replace(".jpg", "");
    
        cont++;
    });
        
}

fetch('http://apilayer.net/api/live?access_key=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', {
    
})
    .then(response => response.json())
    .then(json => {
        var coins = json.quotes;
        var keys = Object.keys(coins);
        var coins = Object.values(json.quotes);

        for (var i = 0; i < keys.length; i++) {
            var option = document.createElement("option");
            option.text = keys[i].replace("USD", "");
            option.setAttribute("value", coins[i]);
            document.getElementById("coins").add(option);
        }  
    })
    .catch(err=> console.error(err));

    function calculate() {
        var numberImages = document.getElementsByTagName("img").length;
        for (var i = 0; i < numberImages; i++) {
            var price = document.getElementById("price" + i); 
            price.innerHTML = price.textContent * document.getElementById("coins").value;
        }
    }