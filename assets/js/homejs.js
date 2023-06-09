$(document).ready(function () {
	//show modal
	$("#modalbutton").click(function () {
		$("#infomodal").modal("show");
	});
	//reset form on click close
	$("#close_button").click(function () {
		$("#form")[0].reset();
	});
	//reset form on click cross X
	$("#cross_close").click(function () {
		$("#form")[0].reset();
	});
	//save registration
	$("#save_button").click(function () {
		var name = $("#name").val().trim();
		var age = $("#age").val().trim();
		var number = $("#p_number").val().trim();

		var country = $("#country").val();
		var province = $("#province").val();
		var district = $("#district").val();
		var municipality = $("#municipality").val();
		var address = $("#address").val().trim();
		var gender = $("input[name='flexRadioDefault']:checked").attr("id");
		var selectedLanguages = [];
		$("input[name='language[]']:checked").each(function () {
			selectedLanguages.push($(this).val());
		});
		var pattern = /^[A-Za-z ]+$/;
		var age_pattern = /^(?:[1-9]|[1-9][0-9])$/;

		var number_pattern = /^[9]\d{9}$/;

		if (name === "") {
			displayFlashMessage("Name is required!", 3000, "flash-messages1");
			return;
		}
		if (!pattern.test(name)) {
			displayFlashMessage(
				"Name must contain only alphabets and spaces!",
				3000,
				"flash-messages1"
			);
			return;
		}
		if (age === "") {
			displayFlashMessage("Age is required!", 3000, "flash-messages1"); // Display for 3 seconds
			return;
		}
		if (!age_pattern.test(age)) {
			displayFlashMessage(
				"Age must contain only numeric!",
				3000,
				"flash-messages1"
			);
			return;
		}
		if (number === "") {
			displayFlashMessage(
				"Phone Number is required !",
				3000,
				"flash-messages1"
			); // Display for 3 seconds
			return;
		}
		if (!number_pattern.test(number)) {
			displayFlashMessage(
				"Insert a valid Phone Number!",
				3000,
				"flash-messages1"
			);
			return;
		}
		if (!country || !province || !district || !municipality) {
			displayFlashMessage(
				"Please select from dropdown !",
				3000,
				"flash-messages1"
			);
			return;
		}

		if (address === "") {
			displayFlashMessage("Address is required !", 3000, "flash-messages1"); // Display for 3 seconds
			return;
		}
		if (!pattern.test(address)) {
			displayFlashMessage(
				"Address must contain only alphabets and spaces!",
				3000,
				"flash-messages1"
			);
			return;
		}
		if (gender === undefined || gender === "") {
			displayFlashMessage("Gender is required!", 3000, "flash-messages1"); // Display for 3 seconds
			return;
		}
		if (selectedLanguages.length === 0) {
			displayFlashMessage("Languages is required !", 3000, "flash-messages1"); // Display for 3 seconds
			return;
		}

		$.ajax({
			url: "Register/save_registration",
			dataType: "json",
			type: "POST",
			data: {
				name: name,
				age: age,
				number: number,
				country: country,
				province: province,
				district: district,
				municipality: municipality,
				address: address,
				gender: gender,
				languages: selectedLanguages,
			},
			success: function (response) {
				if (response.success) {
					fetch();
					$("#infomodal").modal("hide");
					$("#form")[0].reset();

					console.log(response);
				} else {
					console.log(response);
					if (response.errors) {
						// Display validation errors as flash messages
						alert(response.errors);
					}
				}
			},
		});
	});
	// age on click validation
	$("#age").on("input", function () {
		var patient_age = parseInt($(this).val());

		if (patient_age < 1 || patient_age > 100) {
			$(this).val("");
		}
	});

	//phone number on click validation
	$("#p_number").on("input", function () {
		var mobileNumber = $(this).val();

		if (mobileNumber.length > 10) {
			mobileNumber = mobileNumber.slice(0, 10);
			$(this).val(mobileNumber);
		}
	});

	//table fetch of registration information
	function fetch() {
		$.ajax({
			url: "Register/fetch_registration",
			dataType: "json",
			type: "get",
			success: function (response) {
				if (response.success) {
					var tbody = "";
					var i = "1";
					for (var key in response.infodata) {
						tbody += "<tr>";
						tbody += "<td>" + i++ + "</td>";
						tbody += "<td>" + response.infodata[key]["Patientid"] + "</td>";
						tbody += "<td>" + response.infodata[key]["Name"] + "</td>";
						tbody += "<td>" + response.infodata[key]["Age"] + "</td>";
						tbody += "<td>" + response.infodata[key]["Gender"] + "</td>";
						tbody += "<td>" + response.infodata[key]["District"] + "</td>";
						tbody += "<td>" + response.infodata[key]["Address"] + "</td>";
						tbody += "<td>" + response.infodata[key]["DateTime"] + "</td>";
						tbody += `<td>
                        <div class="d-flex">
                            <a href="#" id="view" class="btn btn-primary btn-sm m-1 view" value="${response.infodata[key]["Patientid"]}">View</a>
                            <a href="#" id="reg_bill" class="btn btn-primary btn-sm m-1 reg_bill" value="${response.infodata[key]["Patientid"]}">Reg & Billing</a>
                        </div>
                    </td>`;
						tbody += "</tr>";
					}
					$("#tbody").html(tbody);

					// Initialize DataTable
					$("#myTable").DataTable();
				} else {
					// Display validation errors
					alert(response.errors);
				}
			},
		});
	}
	// Call the fetch function to get table
	fetch();

	//preview the detail information on click view
	$(document).on("click", "#view", function () {
		var Patientid = $(this).attr("value");
		$.ajax({
			url: "Register/fetch_registration_Details",
			dataType: "json",
			type: "post",
			data: {
				patientid: Patientid,
			},
			success: function (response) {
				if (response.success) {
					$("#new-name").val(response.data[0].Name);
					$("#new-age").val(response.data[0].Age);
					$("#new-p_number").val(response.data[0].MobileNumber);
					$("#new-country").val(response.data[0].Country);
					$("#new-province").val(response.data[0].Province);
					$("#new-district").val(response.data[0].District);
					$("#new-municipality").val(response.data[0].Municipality);
					$("#new-address").val(response.data[0].Address);
					$("#new-gender").val(response.data[0].Gender);
					$("#new-language").val(JSON.parse(response.data[0].Language));
					$("#new-infomodal").modal("show");
				} else {
					// Display validation errors
					alert(response.errors);
				}
			},
		});
	});
});

// country in dropdown
$.getJSON("assets/json/country.json", function (data) {
	data.forEach(function (item) {
		$("#country").append(
			`<option value="${item.country}">${item.country}</option>`
		);
	});
});

// province in dropdown;
$("#country").change(function () {
	var selectedCountry = $(this).val();
	if (selectedCountry === "Nepal") {
		$("#province").html('<option value="Choose...">Choose...</option>').show();
		$("#district").html('<option value="Choose...">Choose...</option>').show();
		$("#municipality")
			.html('<option value="Choose...">Choose...</option>')
			.show();

		$.getJSON("assets/json/province.json", function (data) {
			data.forEach(function (item) {
				$("#province").append(
					`<option value="${item.province}">${item.province}</option>`
				);
			});
		});
	} else {
		$("#province").html('<option value="None">None</option>').show();
		$("#district").html('<option value="None">None</option>').show();
		$("#municipality").html('<option value="None">None</option>').show();
	}
});

// Province dropdown
$("#province").change(function () {
	var selectedProvince = $(this).val();

	$("#district")
		.empty()
		.append('<option selected disabled value="">Choose...</option>');

	$.getJSON("assets/json/province.json", function (data) {
		var districts = data.find(function (item) {
			return item.province === selectedProvince;
		});

		if (districts) {
			districts.districts.forEach(function (district) {
				$("#district").append(
					'<option value="' + district + '">' + district + "</option>"
				);
			});
		}
	});
});

//Municapility in dropdown
$("#district").change(function () {
	var selectedDistrict = $(this).val();

	$("#municipality")
		.empty()
		.append('<option selected disabled value="">Choose...</option>');

	if (selectedDistrict === "None") {
		$("#municipality").append('<option value="None">None</option>');
	} else {
		$.getJSON("assets/json/municipality.json", function (data) {
			var districtData = data.find(function (item) {
				return item.district === selectedDistrict;
			});

			if (districtData) {
				districtData.municipalities.forEach(function (municipality) {
					$("#municipality").append(
						'<option value="' + municipality + '">' + municipality + "</option>"
					);
				});

				districtData["rural-municipalities"].forEach(function (
					ruralMunicipality
				) {
					$("#municipality").append(
						'<option value="' +
							ruralMunicipality +
							'">' +
							ruralMunicipality +
							"</option>"
					);
				});
			}
		});
	}
});

// modal show on click reg and billing
$(document).on("click", "#reg_bill", function () {
	var Patientid = $(this).attr("value");
	var currentDate = new Date();
	var year = currentDate.getFullYear();
	var month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
	var day = ("0" + currentDate.getDate()).slice(-2);

	var formattedDate = year + "-" + month + "-" + day;
	$(".p_id").text("Patient Id: " + Patientid);
	$(".bill_date").text("Date: " + formattedDate);

	$("#billing-modal").modal("show");

	// on click reg and billing modal off btn
	$("#billing_modal_close").click(function () {
		$(document).off("click", "#but_add");

		$("#test_name").val("");
		$("#t_unit").val(" ");
		$("#t_qty").val(" ");
		$(".t_price").text(" ");
		$(".sub_total").text(0);
		$("#dis_per").val("");
		$(".dis_amnt").text(0);
		$(".grand_total").text(0);
		$("#items_list").empty();
	});
	// on click reg and billing modal off btn

	$("#modal_close_btn").click(function () {
		$(document).off("click", "#but_add");
		$("#test_name").val("");
		$("#t_unit").val(" ");
		$("#t_qty").val(" ");
		$(".t_price").text(" ");
		$(".sub_total").text(0);
		$("#dis_per").val("");
		$(".dis_amnt").text(0);
		$(".grand_total").text(0);
		$("#items_list").empty();
	});

	//insert unit and qty to get total
	$(document).ready(function () {
		$("#t_unit, #t_qty").on("input", function () {
			var unit = parseFloat($("#t_unit").val());
			var qty = parseFloat($("#t_qty").val());

			// Check if both unit and quantity are valid numbers
			if (!isNaN(unit) && !isNaN(qty)) {
				var price = unit * qty;
				// $("#t_price").val(price);
				$(".t_price").text(price);
			}
		});
	});
	//on click add
	$(document).on("click", "#but_add", function () {
		// alert();
		var testName = $("#test_name").val().trim();
		var quantity = $("#t_qty").val();
		var unit = $("#t_unit").val();
		var price = $(".t_price").text();
		var pattern = /^[0-9]+$/;

		if (testName == "") {
			displayFlashMessage("Test Name is required!", 3000, "flash-messages2");
			return;
		}
		if (quantity == "") {
			displayFlashMessage("Quantity is required !", 3000, "flash-messages2"); // Display for 3 seconds
			return;
		}
		if (!pattern.test(quantity)) {
			displayFlashMessage(
				"Quantity must contain only alphabets and spaces!",
				3000,
				"flash-messages2"
			);
			return;
		}

		if (unit == "") {
			displayFlashMessage("Unit is required !", 3000, "flash-messages2"); // Display for 3 seconds
			return;
		}
		if (!pattern.test(unit)) {
			displayFlashMessage(
				"Unit must contain only alphabets and spaces!",
				3000,
				"flash-messages2"
			);
			return;
		}
		if (price == "") {
			displayFlashMessage("Price is required !", 3000, "flash-messages2"); // Display for 3 seconds
			return;
		}
		$("#test_name").val("");
		$("#t_unit").val(" ");
		$("#t_qty").val(" ");
		$(".t_price").text(" ");

		// Calculate total cost
		var totalCost = parseFloat(quantity) * parseFloat(unit);

		// Append a new row to the table body
		$("#items_list").append(
			"<tr>" +
				"<td>" +
				testName +
				"</td>" +
				"<td>" +
				quantity +
				"</td>" +
				"<td>" +
				unit +
				"</td>" +
				"<td>" +
				price +
				"</td>" +
				"<td><button class='btn btn-danger btn-sm remove-row' id='remove_btn' onclick='rem_item($(this))'>Remove</button></td>" +
				"</tr>"
		);

		var subTotal = parseFloat($(".sub_total").text() || 0);
		subTotal += totalCost;
		$(".sub_total").text(subTotal);
		$(".grand_total").text(subTotal);
		var discount_tab = $("#dis_per").val();
		$("#dis_per").val(discount_tab).trigger("input");
	});
});
// on click  qty
$("#t_qty").on("input", function () {
	var quantity = $("#t_qty").val();
	var pattern = /^\s*([0-9]+)\s*$/;
	if (quantity < 0 || quantity > 1000 || !pattern.test(quantity)) {
		$(this).val("");
	}
});
//on click unit price
$("#t_unit").on("input", function () {
	var unit = $("#t_unit").val();
	var pattern = /^\s*([0-9]+)\s*$/;
	if (unit < 0 || unit > 10000 || !pattern.test(unit)) {
		$(this).val("");
	}
});

// on click remove button
$(document).ready(function () {
	$(document).on("click", "#remove_btn", function () {
		var row = $(this).closest("tr");
		var price = row.find("td:eq(3)").text();
		var total = $(".sub_total").text();
		var final = total - price;
		$(".sub_total").text(final);

		var discount_tab = $("#dis_per").val();
		$("#dis_per").val(discount_tab).trigger("input");
		row.remove();
		var total = $(".sub_total").text();
		if (total == 0) {
			$("#dis_per").val("").trigger("input");
		}
	});
});

//on input discount %
$(document).ready(function () {
	$("#dis_per").on("input", function () {
		// Get input values
		var subTotal = parseFloat($(".sub_total").text() || 0);
		var discountPercent = parseFloat($(this).val()) || 0;

		// Calculate discount amount
		var discountAmount = (subTotal * discountPercent) / 100;

		// Update discount amount field
		$(".dis_amnt").text(discountAmount);

		// Calculate grand total
		var grandTotal = subTotal - discountAmount;

		// Update grand total field
		$(".grand_total").text(grandTotal);
	});
});
//insert item in database
$(document).on("click", "#regbill_btn", function () {
	var total = $(".sub_total").text();

	if (parseFloat(total) === 0) {
		displayFlashMessage("Please submit the form !", 3000, "flash-messages2"); // Display for 3 seconds
		return;
	}
	var p_id = $(".p_id").text().replace("Patient Id: ", "");
	// console.log(p_id);

	var sub_total = $(".sub_total").text();
	var dis_per = $("#dis_per").val();
	var dis_amnt = $(".dis_amnt").text();
	var grand_total = $(".grand_total").text();

	var data = {
		p_id: p_id,
		sub_total: sub_total,
		dis_per: dis_per,
		dis_amnt: dis_amnt,
		grand_total: grand_total,
		items: [], // Array to store the items
	};

	// Iterate over each row in the table to retrieve item information
	$("#items_list tr").each(function () {
		var row = $(this);
		var testName = row.find("td:nth-child(1)").text();
		var quantity = row.find("td:nth-child(2)").text();
		var unit = row.find("td:nth-child(3)").text();
		var price = row.find("td:nth-child(4)").text();

		// Create an object for each item and add it to the items array
		var item = {
			testName: testName,
			quantity: quantity,
			unit: unit,
			price: price,
		};
		data.items.push(item);
	});

	$.ajax({
		url: "Register/save_billing_with_items",
		dataType: "json",
		type: "post",
		data: data,
		success: function (response) {
			if (response.success) {
				console.log(response);

				$(".sub_total").text(0);
				$("#dis_per").val("");
				$(".dis_amnt").text(0);
				$(".grand_total").text(0);
				$("#items_list").empty();
				$("#billing-modal").modal("hide");
				$(document).off("click", "#but_add");
			} else {
				if (response.errors) {
					// Display validation errors as flash messages
					alert(response.errors);
				}
			}
		},
	});
});

// discount % validation
$("#dis_per").on("input", function () {
	var discount_percentage = parseInt($(this).val());
	var pattern = /^[0-9]+$/;
	if (
		discount_percentage < 0 ||
		discount_percentage > 100 ||
		!pattern.test(discount_percentage)
	) {
		$(this).val("");
	}
});

// for flash mesage
function displayFlashMessage(message, duration, targetElementId) {
	var flashMessage = $(
		'<div class="toast w-100" role="alert" aria-live="assertive" aria-atomic="true">' +
			'<div class="toast-body">' +
			message +
			"</div>" +
			"</div>"
	);

	$("#" + targetElementId).append(flashMessage);
	var toast = new bootstrap.Toast(flashMessage[0]);
	toast.show();

	setTimeout(function () {
		flashMessage.toast("dispose");
	}, duration);
}
