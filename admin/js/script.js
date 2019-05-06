


// READ records
function readSessionRecords() {
    $.get("ajax/Sessions/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}



/**
    Disciplines
**/



// READ records
function readBarcodeRecords() {
    $.get("ajax/Barcodes/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteBarcodeDetails(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/Barcodes/deleteBarcode.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readBarcodeRecords();
            }
        );
    }
}

function GetDisciplineDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/Disciplines/readDisciplineDetails.php", {
            id: id
        },
        function (data, status) {//console.log(data);
            // PARSE json data
            var discipline = JSON.parse(data);console.log(discipline)
            // Assing existing values to the modal popup fields
            $("#update_discipline_name").val(discipline.name);
            $("#update_short_name").val(discipline.short_name);
            //$("#update_status").val(user.status);
            //user.status='1'?$("#update_status").checked(true):$("#update_status").checked(false);
            // ((user.status == 1) ?$("#update_status").prop('checked', true):$("#update_status").prop('checked', false));
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateDisciplineDetails() {
    // get values
    var update_discipline_name = $("#update_discipline_name").val();
    var update_short_name = $("#update_short_name").val();//alert(update_discipline_name)
    // get hidden field value
    var id = $("#hidden_user_id").val();
    //alert(id)
    // Update the details by requesting to the server using ajax
    $.post("ajax/Disciplines/updateDisciplineDetails.php", {
            id: id,
            update_discipline_name: update_discipline_name,
            update_short_name: update_short_name,
        },
        function (data, status) {//alert(data)
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readDisciplineRecords();
        }
    );
}










// READ records
function readUserRecords() {
    $.get("ajax/Users/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/Users/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readUserRecords();
            }
        );
    }
}


$(document).ready(function () {
    // READ recods on page load


    var url = document.location.href;
    if (url== 'http://localhost/usms/admin/barcode-manage.php' || url== 'http://localhost/usms/admin/barcode-manage.php?success=1' || url== 'http://localhost/usms/admin/barcode-manage.php?#') {
      readBarcodeRecords();
    }if(url== 'http://localhost/olms/admin/session-manage.php' || url=='http://localhost/olms/admin/session-manage.php?success=1' || url=='http://localhost/olms/admin/session-manage.php?#') {
        readSessionRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/authors-manage.php' || url=='http://localhost/olms/admin/authors-manage.php?success=1' || url=='http://localhost/olms/admin/authors-manage.php?#') {
        readAuthorRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/books-manage.php' ||  url=='http://localhost/olms/admin/books-manage.php?success=1' || url=='http://localhost/olms/admin/books-manage.php?#') {
        readBookRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/bookissue-manage.php' || url=='http://localhost/olms/admin/bookissue-manage.php?success=1' || url=='http://localhost/olms/admin/bookissue-manage.php?book-issue-available-1=1') {
        readBookIssueRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/users-manage.php' || url=='http://localhost/olms/admin/users-manage.php?success=1' || url=='http://localhost/olms/admin/users-manage.php?fkeyconstraint=1' || url=='http://localhost/olms/admin/users-manage.php?#') {
        readUserRecords(); // calling function
    }

    
    


    
   
    // Pagination initiates
 $.ajax({
 url:"ajax/Barcodes/pagination.php",
 type:"POST",
 data:"actionfunction=showData&page=1",
 cache: false,
 success: function(response){

 $('#pagination').html(response);

 }

 });
 $('#pagination').on('click','.page-numbers',function(){
 $page = $(this).attr('href');
 $pageind = $page.indexOf('page=');
 $page = $page.substring(($pageind+5));

 $.ajax({
 url:"ajax/pagination.php",
 type:"POST",
 data:"actionfunction=showData&page="+$page,
 cache: false,
 success: function(response){

 $('#pagination').html(response);

 }

 });
 return false;
 });
});