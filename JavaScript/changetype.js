var temp;
var verify;

function changetype(librarianID){

    let status = document.getElementById("typeButton" + librarianID);

    if(temp == "Head Librarian"){
        verify = confirm("Are you sure you want to change type from Head Librarian to Librarian");
    }
    else{
        verify = confirm("Are you sure you want to change type from Librarian to Head Librarian");
    }

    if(verify){
        $.ajax({
            url : 'accounttypeChanger - librarian.php',
            type : 'POST',
            data: {
                ID : librarianID
            },
            success : function (result) {
            console.log (result);
            console.log('Nice');
            },
            error : function () {
            console.log ('error');
            }
        });

        if(temp == "Head Librarian"){
            document.getElementById("typeButton" + librarianID).classList.remove('btn-danger');
            document.getElementById("typeButton" + librarianID).classList.add('btn-success');
            temp = "Librarian";
            console.log("Librarian");
        }
        else{
            document.getElementById("typeButton" + librarianID).classList.remove('btn-success');
            document.getElementById("typeButton" + librarianID).classList.add('btn-danger');
            temp = "Head Librarian";
            console.log("Head Librarian");
        }
    }
}

function typehover(librarianID){
    let status = document.getElementById("typeButton" + librarianID);

    document.getElementById("typeButton" + librarianID).classList.remove('btn-warning');
    document.getElementById("typeButton" + librarianID).classList.add('btn-danger');
    temp = status.innerHTML;
    status.innerHTML = "Change Type";
    console.log("Enter: still Enabled");
}

function typehoverOut(librarianID){
    let status = document.getElementById("typeButton" + librarianID);

    document.getElementById("typeButton" + librarianID).classList.remove('btn-danger');
    document.getElementById("typeButton" + librarianID).classList.add('btn-warning');
    status.innerHTML = temp;
    console.log("Exit: still Disabled");
}



