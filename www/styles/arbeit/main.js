function chkFormularComment()
    {
        if((document.getElementById("name").value == "") ||
           (document.getElementById("title").value == "") ||
           (document.getElementById("text").value == ""))
        {
            alert ("Du hast nicht alle Felder ausgef�llt");
            return false;
        }
    }
    
function chkFormularNewsSearch()
    {
        if (document.getElementById("keyword").value.length < "4")
        {
            alert("Es m�ssen mehr als 3 Zeichen sein");
            return false;
        }
    }

function chkFormularRegister() 
{
    if((document.getElementById("username").value == "") ||
       (document.getElementById("usermail").value == "") ||
       (document.getElementById("newpwd").value == "") ||
       (document.getElementById("wdhpwd").value == ""))
    {
        alert("Du hast nicht alle Felder ausgef�llt"); 
        return false;
    }
    if(document.getElementById("newpwd").value != document.getElementById("wdhpwd").value)
    {
        alert("Passw�ter sind verschieden"); 
        return false;
    }
}