// JavaScript Document
$(document).ready(function () {
    //$('select').niceSelect();
	$('#checkbox_detail').change(function(){
        if (this.checked) {
            $('.detailed-check-main').fadeIn('slow');
        }
        else {
            $('.detailed-check-main').fadeOut('slow');
        }                   
    });

	$('#flip-data-table').DataTable( {
		searching: false, paging: false, info: false,ordering: false,
		fixedColumns: {
			leftColumns: 2
			
		}
	});
	   
	$('[data-toggle="tooltip"]').tooltip({delay: { "show": 200, "hide": 100 }})

	$(document).on("click", "[data-column]", function () {
		var button = $(this),
			header = $(button.data("column")),
			table = header.closest("table"),
			index = header.index() + 1, // convert to CSS's 1-based indexing
			selector = "tbody tr td:nth-child(" + index + ")",
			column = table.find(selector).add(header);
  
		column.toggleClass("hidden");
	});

	$(document).ready(function(){
	    $(".dropdown").hover(function(){
	        var dropdownMenu = $(this).children(".dropdown-menu");
	        if(dropdownMenu.is(":visible")){
	            dropdownMenu.parent().toggleClass("open");
	        }
	    });
	});     
});

	