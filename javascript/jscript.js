
//========================= change categories=====================
	$(document).ready(function () {
		$(".forms").css("display", "none");
		$(".tables").css("display", "none");
		$(".expenses-form").css("display", "block");
		$('.0').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".expenses-form").css("display", "block");
		});

		$('.1').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".lender-form").css("display", "block");
		});

		$('.2').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".borrow-form").css("display", "block");
		});

		$('.3').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".investment-form").css("display", "block");
		});

		$('.4').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".income-form").css("display", "block");
		});
		$('.11').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".notreceive_table").css("display", "block");
		});
		$('.12').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".notreturn_table").css("display", "block");
		});
	});
//========================= SweetAlert for submition of form data=====================


    
	// const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	// const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


    // ====================All form validation=================================

	$.validator.addMethod("noSpace", function (value, element) {
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed");

	$('#e-form').validate({
		rules: {
			e_name: {
				required: true,
				noSpace: true
			},
			e_amount: {
				required: true,
				noSpace: true,
				digits: true
			},

			e_desc: {
				required: true,
				noSpace: true
			}
		},
		messages: {
			e_name: {
				required: "username is required!"
			},
			e_amount: {
				required: "amount is required!",
				digits: "Please enter only digits!"
			},
			e_desc: {
				required: "description is required!",
			}
		},
		submitHandler: function (form) {
			form.submit();
		}
	});

	$('#l-form').validate({
		rules: {
			l_name: {
				required: true,
				noSpace: true
			},
			l_amount: {
				required: true,
				noSpace: true,
				digits: true
			},
			l_desc: {
				required: true,
				noSpace: true
			},
			l_cdate: {
				required: true,
			},
			l_rdate: {
				required: true,
			},
		},
		messages: {
			l_name: {
				required: "username is required!"
			},
			l_amount: {
				required: "amount is required!",
				digits: "Please enter only digits!"
			},
			l_desc: {
				required: "description is required!",
			},
			l_cdate: {
				required: "current date is required!",
			},
			l_rdate: {
				required: "return date is required!"
			}
		},
		submitHandler: function (form) {
			form.submit();
		}
	});

	$('#b-form').validate({
		rules: {
			b_name: {
				required: true,
				noSpace: true
			},
			b_amont: {
				required: true,
				noSpace: true,
				digits: true
			},
			b_desc: {
				required: true,
				noSpace: true
			},
			b_cdate: {
				required: true,
			},
			b_rdate: {
				required: true,
			},
		},
		messages: {
			b_name: {
				required: "username is required!"
			},
			b_amont: {
				required: "amount is required!",
				digits: "Please enter only digits!"
			},
			b_desc: {
				required: "description is required!",
			},
			b_cdate: {
				required: "current date is required!",
			},
			b_rdate: {
				required: "return date is required!"
			}
		},
		submitHandler: function (form) {
			form.submit();
		}
	});

	$('#i-form').validate({
		rules: {
			i_name: {
				required: true,
				noSpace: true
			},
			i_amont: {
				required: true,
				noSpace: true,
				digits: true
			},
			i_desc: {
				required: true,
				noSpace: true
			},
			i_cdate: {
				required: true,
			}
		},
		messages: {
			i_name: {
				required: "username is required!"
			},
			i_amont: {
				required: "amount is required!",
				digits: "Please enter only digits!"
			},
			i_desc: {
				required: "description is required!",
			},
			i_cdate: {
				required: "current date is required!",
			}
		},
		submitHandler: function (form) {
			form.submit();
		}
	});

	$('#in-form').validate({
		rules: {
			inc_name: {
				required: true,
				noSpace: true,
			},
			inc_amont: {
				required: true,
				noSpace: true,
				digits: true
			},
			inc_desc: {
				required: true,
				noSpace: true
			},
			inc_cdate: {
				required: true,
			}
		},
		messages: {
			inc_name: {
				required: "username is required!"
			},
			inc_amont: {
				required: "amount is required!",
				digits: "Please enter only digits!"
			},
			inc_desc: {
				required: "description is required!",
			},
			inc_cdate: {
				required: "current date is required!",
			}
		},
		submitHandler: function (form) {
			form.submit();
		}
	});
