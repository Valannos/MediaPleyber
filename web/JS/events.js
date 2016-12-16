/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




console.log('AJAX Request');

var makeAJAXRequest = function() {
    
    var xmlhttp = new XMLHttpRequest();
    
    if (xmlhttp.readyState === XMLHttpRequest.DONE) {
        if (xmlhttp.status === 200) {
            document.getElementById('json').innerHTML = xmlhttp.responseText;
        } else if (xmlhttp.status === 400) {
            document.getElementById('json').innerHTML = 'erreur 400';
        } else {
            document.getElementById('json').innerHTML = 'erreur fatale';
        }

    }
    
    xmlhttp.open("GET", "", true);
    xmlhttp.send();
    
    
};
