$(document).ready(function () {
	// show datatables

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
			displayFlashMessage("Name is required !", 3000); // Display for 3 seconds
			return;
		}
		if (!pattern.test(name)) {
			displayFlashMessage("Name must contain only alphabets and spaces!", 3000);
			return;
		}
		if (age === "") {
			displayFlashMessage("Age is required !", 3000); // Display for 3 seconds
			return;
		}
		if (!age_pattern.test(age)) {
			displayFlashMessage("Age must contain only numeric!", 3000);
			return;
		}
		if (number === "") {
			displayFlashMessage("Number is required !", 3000); // Display for 3 seconds
			return;
		}
		if (!number_pattern.test(number)) {
			displayFlashMessage("Invalid Number!", 3000);
			return;
		}
		if (!country || !province || !district || !municipality) {
			displayFlashMessage("Please select from dropdown !", 3000);
			return;
		}

		if (address === "") {
			displayFlashMessage("Address is required !", 3000); // Display for 3 seconds
			return;
		}
		if (gender === undefined || gender === "") {
			displayFlashMessage("Gender is required!", 3000); // Display for 3 seconds
			return;
		}
		if (selectedLanguages.length === 0) {
			displayFlashMessage("Languages is required !", 3000); // Display for 3 seconds
			return;
		}

		$.ajax({
			url: "Home_con/save_info",
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
					$("#infomodal").modal("hide");
					$("#form")[0].reset();
					fetch();

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

	//table fetch
	function fetch() {
		$.ajax({
			url: "Home_con/fetch_info",
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

	// Call the fetch function to populate the table and initialize the DataTable
	fetch();
	fetch();
	//preview the information on click view
	// TODO: on and off
	$(document).on("click", "#view", function () {
		var Patientid = $(this).attr("value");
		$.ajax({
			url: "Home_con/fetch_all",
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
		// $("#province").show();
	} else {
		$("#province").html('<option value="None">None</option>').show();
		$("#district").html('<option value="None">None</option>').show();
		$("#municipality").html('<option value="None">None</option>').show();
	}
});

// Add event listener to the "Province" dropdown
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
	$("#p_id").val(Patientid);
	$.ajax({
		url: "Home_con/getdate",
		dataType: "json",
		type: "get",
		data: {},
		success: function (response) {
			// console.log(response.data);
			$("#bill_date").val(response.data);
		},
	});

	$("#billing-modal").modal("show");

	//on click add
	$(document).ready(function () {
		$("#but_add").click(function () {
			// alert();
			var testName = $("#test_name").val();
			var quantity = $("#t_qty").val();
			var unit = $("#t_unit").val();
			var price = $("#t_price").val();
			if (!testName) {
				displayFlashMessage("Test Name is required !", 3000); // Display for 3 seconds
				return;
			}
			if (!unit) {
				displayFlashMessage("Unit is required !", 3000); // Display for 3 seconds
				return;
			}
			if (!quantity) {
				displayFlashMessage("Quantity is required !", 3000); // Display for 3 seconds
				return;
			}

			if (!price) {
				displayFlashMessage("Price is required !", 3000); // Display for 3 seconds
				return;
			}
			$("#bill_form")[0].reset();

			// Calculate total cost
			var totalCost = parseFloat(quantity) * parseFloat(unit);

			// Append a new row to the table body
			$("#item-list tbody").append(
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
					"<td><button class='btn btn-danger btn-sm remove-row' id='remove_btn'  onclick='rem_item($(this))'>Remove</button></td>" +
					"</tr>"
			);

			var subTotal = parseFloat($("#sub_total").val() || 0);
			subTotal += totalCost;
			$("#sub_total").val(subTotal);
			$("#grand_total").val(subTotal);
			var discount_tab = $("#dis_per").val();
			// TODO: valid the discount percentage
			$("#dis_per").val(discount_tab).trigger("input");
		});
	});

	//insert unit and qty to get total
	$(document).ready(function () {
		$("#t_unit, #t_qty").on("input", function () {
			var unit = parseFloat($("#t_unit").val());
			var qty = parseFloat($("#t_qty").val());

			// Check if both unit and quantity are valid numbers
			if (!isNaN(unit) && !isNaN(qty)) {
				var price = unit * qty;
				$("#t_price").val(price);
			}
		});
	});

	// on click rmove button
	$(document).ready(function () {
		$(document).on("click", "#remove_btn", function () {
			var row = $(this).closest("tr");

			var price = row.find("td:eq(3)").text();
			var total = $("#sub_total").val();
			var final = total - price;
			$("#sub_total").val(final);

			var discount_tab = $("#dis_per").val();
			$("#dis_per").val(discount_tab).trigger("input");
			row.remove();
		});
	});

	//on input discount %
	$(document).ready(function () {
		$("#dis_per").on("input", function () {
			// Get input values
			var subTotal = parseFloat($("#sub_total").val()) || 0;
			var discountPercent = parseFloat($(this).val()) || 0;

			// Calculate discount amount
			var discountAmount = (subTotal * discountPercent) / 100;

			// Update discount amount field
			$("#dis_amnt").val(discountAmount);

			// Calculate grand total
			var grandTotal = subTotal - discountAmount;

			// Update grand total field
			$("#grand_total").val(grandTotal);
		});
	});

	$(document).on("click", "#regbill_btn", function () {
		var bill_date = $("#bill_date").val();
		var p_id = $("#p_id").val();
		var sub_total = $("#sub_total").val();
		var dis_per = $("#dis_per").val();
		var dis_amnt = $("#dis_amnt").val();
		var grand_total = $("#grand_total").val();
		var items = [];

		$("#item-list tbody tr").each(function () {
			var row = $(this); // Current <tr> element
			var testName = row.find("td:nth-child(1)").text(); // Value of the first <td>
			var quantity = row.find("td:nth-child(2)").text(); // Value of the second <td>
			var unit = row.find("td:nth-child(3)").text(); // Value of the third <td>
			var price = row.find("td:nth-child(4)").text(); // Value of the fourth <td>

			// Create an object to represent the row data
			var item = {
				testName: testName,
				quantity: quantity,
				unit: unit,
				price: price,
			};

			items.push(item); // Add the row data to the items array
		});

		$.ajax({
			url: "Home_con/save_billing",
			dataType: "json",
			type: "post",
			data: {
				bill_date: bill_date,
				p_id: p_id,
				sub_total: sub_total,
				dis_per: dis_per,
				dis_amnt: dis_amnt,
				grand_total: grand_total,
			},
			success: function (response) {
				console.log(response);
			},
		});

		// console.log(items);
	});
});
// for flash mesage
function displayFlashMessage(message, duration) {
	var flashMessage = $(
		'<div class="toast w-100" role="alert" aria-live="assertive" aria-atomic="true">' +
			'<div class="toast-body">' +
			message +
			"</div>" +
			"</div>"
	);

	$("#flash-messages").append(flashMessage);
	$("#flash-messages2").append(flashMessage);

	var toast = new bootstrap.Toast(flashMessage[0]);
	toast.show();

	setTimeout(function () {
		flashMessage.toast("dispose");
	}, duration);
}
