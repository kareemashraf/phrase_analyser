$(document).ready(function(){


    $('#myTable').DataTable({
    	select: true,
    	ordering: true,
    	searching: false, //disable the Datatable search bar
    	paging: true,
    	pageLength: 50

    });


});