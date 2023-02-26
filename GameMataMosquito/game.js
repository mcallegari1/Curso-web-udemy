
var height = window.innerHeight;
var width  = window.innerWidth; 
var vidas  = 1;
var tempo  = 10;

var criaMosquitoTempo = 1500;

var nivel =  window.location.search.replace('?', '');
if(nivel === 'facil'){
    criaMosquitoTempo = 1500;
} else if(nivel === 'medio'){
    criaMosquitoTempo = 1000;
} else {
    criaMosquitoTempo = 750;
}

window.onresize = function() {
    height = window.innerHeight;
    width  = window.innerWidth;
}

cronometro = setInterval(function() {

    if(tempo > 0){
        tempo --;
        document.getElementById('cronometro').innerHTML = tempo;

    } else {
        clearInterval(criaMosquito);
        clearInterval(cronometro);
        window.location.href = "vitoria.html";
    }
}, 1000)

function randomPosition() {

    if(document.getElementById('mosquito')){
        document.getElementById('mosquito').remove();

        if(vidas > 3){
        
            window.location.href = "gameover.html";
            
        } else{
            document.getElementById('v' + vidas).src = "imagens/coracao_vazio.png"
            vidas ++;
        }
    }

    var posX = Math.floor(Math.random() * width) - 90;
    var posY = Math.floor(Math.random() * height) - 90;
    
    posX = posX < 0 ? 0 : posX;
    posY = posY < 0 ? 0 : posY;

    var mosquito = document.createElement('img');
    mosquito.src = 'imagens/mosca.png';
    mosquito.className = getRandomClass() + ' ' + randomSide();
    mosquito.style.left = posX + 'px';
    mosquito.style.top  = posY + 'px';
    mosquito.id = 'mosquito';
    mosquito.onclick = function(){
        this.remove();
    }

    document.body.append(mosquito);
}

function getRandomClass() {
    var x = Math.floor(Math.random() * 3);

    switch (x){
        case 0:
            return 'mosquito1';
        case 1:
            return 'mosquito2';
        case 2:
            return 'mosquito3';
    }
}

function randomSide() {
    var x = Math.floor(Math.random() * 2);
    console.log(x);

    switch (x){
        case 0:
            return '';
        case 1:
            return 'flip';
    }
}
