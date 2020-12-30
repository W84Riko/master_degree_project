function GetAllClasses() {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var div=document.createElement('div');
            div.innerHTML=this.responseText;
            document.getElementById("mainContent").append(div);
        }
    };
    xhttp.open("POST", "getAllClasses.php", true);
    xhttp.send();
}

function getAllSubcategories(idCode) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {                     
            var results=this.responseText;
            var currentTableRow=idCode.parentNode;            
            var searchCurPos=0;            
            while(results.includes('<tr>', searchCurPos)){
                var newRow=document.createElement('tr');
                var newRowStartPos = results.indexOf('<tr>', searchCurPos)+4;
                var newRowEndPos = results.indexOf('</tr>', searchCurPos);
                var newRowStr = results.slice(newRowStartPos, newRowEndPos);
                newRow.innerHTML=newRowStr;
                currentTableRow.parentNode.insertBefore(newRow, currentTableRow.nextSibling);
                currentTableRow=newRow;
                searchCurPos=results.indexOf('</tr>', searchCurPos)+5;
            }
        }
    };                                                        
    var str = "code=" + idCode.innerHTML;    
    xhttp.open("POST", "getAllSubcategories.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(str);
    idCode.onclick=idleFunction;
}

function Search(btn) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {          
            var section = document.getElementById("mainContent");
            section.removeChild(section.lastChild);
            var newTable = document.createElement('table');
            newTable.innerHTML="<tr><th>Код рубрики</th><th>Назва рубрики</th></tr>" + this.responseText;
            section.append(newTable);
        }
    };    
    xhttp.open("POST", "listSearch.php", true);
    var str=document.getElementById('searchField').name + "=" + document.getElementById('searchField').value; 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(str);
}

function idleFunction(){
    var currentTableRow=this.parentNode;
    var nextTableRow=currentTableRow.nextSibling;
    var code=nextTableRow.firstChild.innerHTML;
    while(this.innerHTML.length != code.length){
        nextTableRow.remove();   
        nextTableRow=currentTableRow.nextSibling;
        code=nextTableRow.firstChild.innerHTML;
    }
}