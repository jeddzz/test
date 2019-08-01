//Добавление пользователя в базу
$('#registration').submit(function(e){
	
	alert('Клик');
    e.preventDefault();
    var data = new FormData(this);
	var cntEmail=$.trim($("#email").val());
	var cntName=$.trim($("#name").val());
	
	if(cntEmail.length<3 && cntName.length<3) {
		$("#email").addClass("bg-danger");
		$("#name").addClass("bg-danger");
		$(".form-control-feedback").text('Заполните все поля');
		return;
	}
	
    $.ajax({
        type:'POST',
        url: 'handler.php',
        data: data,
		contentType: "application/json; charset=utf-8",
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            swal({
                title: "Отлично!",
                text: "Пользователь успешно зарегистрирован!",
                icon: "success",
            }).then(() => {
                location.reload();
            });
        },
        error: function(response){
			
			var errors = response.responseJSON;
			if (typeof errors !== 'undefined') {
			var user_card = JSON.parse(errors.user_card);
			$('.user_card').html('<div class="card p-3 bg-info text-white"><h3 class="text-center mb-4">Пользователь с таким email уже существует!</h3>'+
			'<p><b>Имя:</b> '+user_card['name']+'</p><p><b>Email:</b> '+user_card['email']+'</p><p><b>Адрес:</b> '+user_card['ter_address']+'</p></div>');
			}
		   
           if (errors.errors) {
               errors.errors.forEach(function(data, index) {
                   var field = Object.getOwnPropertyNames (data);
                   var value = data[field];
                   var div = $("#"+field[0]).closest('div');
                   div.addClass('has-danger');
                   div.children('.form-control-feedback').text(value);
				   //$("#btn-reg").attr("disabled", true);
				   $( "#SelectedDistr" ).empty();
               });
           }
        }
    });
});


$(document).ready(function(){
ChosenSelect();	
    $("#SelectedRegion").change(function(){

        var selectedRegion = $(this).children("option:selected").val();	
		$.ajax({
			type:'POST',
			url: 'app/ajax.php',
			data: 'typePost=city&ter_pid='+selectedRegion,

			datatype: "html",
			success: function(result){
				$('.reslt1').html(result);
				ChosenSelect();
				$( ".reslt2" ).empty();
			},
			error: function(response, status, error){
			   var errors = response.responseJSON;
			}
		});
    });

    $("#SelectedCity").change(function() {
        var selectedDistrict = $("#SelectedDistrict").children("option:selected").val();
		$.ajax({
			type:'POST',
			url: 'app/ajax.php',
			data: 'typePost=city2&ter_pid='+selectedDistrict,
			datatype: "html",
			success: function(result){
				 $('.reslt2').html(result);
				 ChosenSelect();
				 $("#btn-reg").removeAttr('disabled');
			},
			error: function(response, status, error){
			   var errors = response.responseJSON;

			   if (errors.errors) {
				   alert('Error');

			   }
			}
		});
    });
	
	// Select with chosen
	function ChosenSelect() {
	  $(".chosen-select").chosen({
		  width: "100%",
		  disable_search: false,
		  disable_search_threshold: 5,
		  enable_split_word_search: false,
		  max_selected_options: 10,
		  no_results_text: "Ничего не найдено",
		  placeholder_text_multiple: "Выберите несколько параметров",
		  placeholder_text_single: "Выберите параметр",
		  search_contains: true,
		  display_disabled_options: false,
		  display_selected_options: false,
		  max_shown_results: Infinity
	  });
	}
});