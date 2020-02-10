var config={
    type: Phaser.AUTO,
    width: 800,
    height: 600,
    physics: {
        default: 'arcade',
        arcade:{
            gravity: {y: 300},
            debug: false
        }
    },
    scene:{
        preload: preload,
        create: create,
        update: update
    }
};

//VARIABLES GLOBALES
var player;
var plumbus;
var timecops;
var portalgun;
var portal;
var plataforms;
var cursors;
var score=0;
var gameOver = false;
var scoreText;
var levelText;
var nivel= 1;
var gameOverText;
var topPuntuacion = new Array(0,0,0,0,0);
var puntuacionText;
var posicionesY = [400, 250, 200];

var game = new Phaser.Game(config);

function preload(){
    this.load.image('fondo', 'assets/fondo.png');
    this.load.image('fondo_negro', 'assets/fondonegro.png');
    this.load.image('plumbus', 'assets/plumbus.png');
    this.load.image('portal', 'assets/portal.png');
    this.load.image('portalgun', 'assets/portalgun.png');
    this.load.image('timecops', 'assets/timecop.png');
    this.load.image('plataforma', 'assets/platform.png');
    this.load.spritesheet('morty','assets/morty.png',{frameWidth: 32, frameHeight: 40});

}

function create(){
    //IMG STATICOS
    this.add.image(400,300, 'fondo');

    //PLATAFORMAS
    plataforms = this.physics.add.staticGroup();
    plataforms.create(400, 568, 'plataforma').setScale(1.14).refreshBody();
    plataforms.create(600, 400, 'plataforma').setScale(0.5).refreshBody();
    plataforms.create(50, 250, 'plataforma').setScale(0.5).refreshBody();
    plataforms.create(750, 220, 'plataforma').setScale(0.5).refreshBody();

    //PERSONAJE - rebote con los marcos del juego
    player=this.physics.add.sprite(100, 450, 'morty');
    player.setBounce(0);
    player.setCollideWorldBounds(true);

    //PERSONAJE - animaciones: quieto, derecha y izquierda
    //PARADO
    this.anims.create({
        key: 'quieto',
        frames: [{key: 'morty', frame: 4}],
        frameRate: 0
    });

    //DERECHA
    this.anims.create({
        key: 'derecha',
        frames: this.anims.generateFrameNumbers('morty',{start:5,end:8}),
        frameRate:10,
        repeat: -1
    });

    //IZQUIERDA
    this.anims.create({
        key: 'izquierda',
        frames: this.anims.generateFrameNumbers('morty',{start:0,end:3}),
        frameRate:10,
        repeat: -1
    });

    //COLISION CON PLATAFORMAS
    this.physics.add.collider(player,plataforms);

    //COMPROBACION DE CURSOER - por flechas
    cursors = this.input.keyboard.createCursorKeys();

    //OBJETOS DINAMICOS
    plumbus=this.physics.add.group({
        key: 'plumbus',
        repeat: 3
    });

    //OBJETO COLISION CON PLATAFORMAS
    this.physics.add.collider(plataforms,plumbus);

    //CREACION DE PLUMBUS
    plumbus.children.iterate(function(child){
        createPlumbus(child); 
    });

    //SOLAPAMIENTO ENTRE PERSONAJE Y PLUMBUS
    this.physics.add.overlap(player,plumbus,collectPumblus,null,this);

    //TEXTO SCORE
    scoreText=this.add.text(16,54,'Score: 0',{fontSize: '32px', fill:'#000'});
    //TEXTO LVL
    levelText=this.add.text(16,10,'Level: '+nivel,{fontSize: '32px', fill:'#000'});


    //PISTOLA Y PORTAL
    portalgun = this.physics.add.image(Phaser.Math.Between(10, 790), posicionesY[Phaser.Math.Between(0, 2)], 'portalgun');
    portal = this.physics.add.image(400, 400, 'portal');
    portal.disableBody(true,true);

    //COLISIONES PISTOLA Y PORTAL CON PLATAFORMAS
    this.physics.add.collider(plataforms,portal);
    this.physics.add.collider(plataforms,portalgun);

    //SOLAPAMIENTO PERSONAJE CON PISTOLA Y PORTAL
    this.physics.add.overlap(player,portalgun,hitPistola,null,this);
    this.physics.add.overlap(player,portal,hitPortal,null,this);

    //ENEMIGOS
    timecops = this.physics.add.group();

    //COLISIONES ENEMIGO Y PLATAFORMAS
    this.physics.add.collider(plataforms, timecops);

    //SOLAPAMIENTO ENEMIGO VS JUGADOR
    this.physics.add.overlap(player, timecops,hitTimecops,null,this);

}


function update(){

    ///////////////////////////////////////////         hitTimecops
    /*    this.add.image(400,300, 'fondo_negro');
    //TEXTO GAME OVER
    gameOverText=this.add.text(180,250,'GAME OVER',{fontSize: '80px', fill:'red'});
    scoreText=this.add.text(30,550,'Score: '+score,{fontSize: '32px', fill:'white'});
    levelText=this.add.text(30,520,'Level: '+nivel,{fontSize: '32px', fill:'white'});
    puntuacionText=this.add.text(290,320,'PUNTUACIÓN ',{fontSize: '32px', fill:'red'});
    this.add.text(330,370,'1 ---- 20',{fontSize: '22px', fill:'red'});*/

    /////////////////////////////////////////////


    if(cursors.left.isDown){
        player.anims.play('izquierda',true);
        player.setVelocityX(-200);

    }else if(cursors.right.isDown){
        player.anims.play('derecha',true);
        player.setVelocityX(200);
    }else{
        player.anims.play('quieto',false);
        player.setVelocityX(0);
    }

    if(cursors.up.isDown && player.body.touching.down){
        player.setVelocityY(-300);

    }

    if(gameOver){        
        return;
    }
}

function hitTimecops(player, timecops){
    this.physics.pause();
    player.setTint(0xff0000);
    player.anims.play('turn');
    gameOver = true;

    array='';
    //GUARDANDO PUNTUACION EN COOKIE
    if(getCookie('puntuacion') != null){
        console.log('entra en crear');
        array= JSON.parse(getCookie('puntuacion'));
    }else{
        console.log('entra en creado');
        array=setCookie("puntuacion", JSON.stringify(topPuntuacion), 365);
    }

    for(var i=0;i<array.length;i++){
        if(array[i] < score){
            array[i]=score;
            break;
        }
    }

    array = Burbuja(array).reverse();
    console.log(array);   

    this.add.image(400,300, 'fondo_negro');
    //TEXTO GAME OVER
    gameOverText=this.add.text(150,180,'GAME OVER',{fontFamily:'Tahoma',fontSize: '100px', fill:'red'});
    scoreText=this.add.text(30,550,'Score: '+score,{fontSize: '32px', fill:'white'});
    levelText=this.add.text(30,520,'Level: '+nivel,{fontSize: '32px', fill:'white'});
    puntuacionText=this.add.text(290,320,'PUNTUACIÓN ',{fontSize: '32px', fill:'red'});
    for(var i=0;i<array.length;i++){
        var num=i+1;
        var posicion=370+(i*30);
        this.add.text(330,posicion,num+' ---- '+array[i],{fontSize: '22px', fill:'red'});
    }

    setCookie("puntuacion", JSON.stringify(array), 365);
    console.log(getCookie('puntuacion'));



}
//METODO POR BURBUJA
function Burbuja(array) {
    var n, i, k, aux;
    n = array.length;
    console.log(array); // Mostramos, por consola, la lista desordenada
    // Algoritmo de burbuja
    for (k = 1; k < n; k++) {
        for (i = 0; i < (n - k); i++) {
            if (array[i] > array[i + 1]) {
                aux = array[i];
                array[i] = array[i + 1];
                array[i + 1] = aux;
            }
        }
    }
    console.log(array);
    return array; // Mostramos, por consola, la lista ya ordenada
}

function hitPistola(player, pistola){
    pistola.disableBody(true,true);
    portal.enableBody(true,Phaser.Math.Between(10, 790),posicionesY[Phaser.Math.Between(0,2)], true, true);

}

function hitPortal(player,elPortal){
    nivel++;
    elPortal.disableBody(true,true);
    player.disableBody(true,true);
    plumbus.children.iterate(function(child){
        child.enableBody(true, child.x,0,true,true);
        createPlumbus(child);
    });

    player.enableBody(true, Phaser.Math.Between(10,790), posicionesY[Phaser.Math.Between(0,2)],true,true);
    portalgun.enableBody(true, Phaser.Math.Between(10, 790), posicionesY[Phaser.Math.Between(0,2)],true,true);
    levelText.setText('Level: '+nivel);

    //ENEMIGO
    if(nivel%2 == 0){
        var x = (player.x < 400) ? Phaser.Math.Between(400, 800) : Phaser.Math.Between(0, 400);
        var timecop = timecops.create(x, 16, 'timecops');
        timecop.setBounce(1);
        timecop.setCollideWorldBounds(true);
        timecop.setVelocity(Phaser.Math.Between(-200, 200), 50);
        timecop.allowGravity = false;
    }
}


function createPlumbus(plumbus){
    plumbus.setBounceY(Phaser.Math.FloatBetween(0.4,0.8));
    plumbus.x=Phaser.Math.Between(10,790);
    plumbus.y=posicionesY[Phaser.Math.Between(0,2)];
}

function collectPumblus(player,plumbus){
    plumbus.disableBody(true,true);
    score+=10*nivel;
    scoreText.setText('Score: '+score);
}




/*FUNCIÓN: Crear cookies
cname-> nombre de la variable
cvalue-> valor de la variable
exdays-> dias que tardara hasta la expiración
*/
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/*FUNCIÓN: Visualizar la información de la cookie
cname-> nombre de la variable
*/
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}

/*FUNCIÓN: Borrar una cookie
cname-> nombre de la varible
*/ 
function deleteCookie(cname) {
    var valor = cname+'=; expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
    document.cookie = valor;
}


